<?php

namespace App\Services\Stream;

use Illuminate\Support\Facades\Http;
use Throwable;

class StreamNotifier
{
    public const ACTION_CREATED = 'created';

    public const ACTION_UPDATED = 'updated';

    public const ACTION_DELETED = 'deleted';

    public function __construct(
        private readonly string $url,
        private readonly string $token,
    ) {
    }

    /**
     * Beri tahu Node stream service agar me-resync kamera tertentu segera.
     *
     * Best-effort (fire-and-forget): bila pengiriman gagal, polling berkala
     * RESYNC_INTERVAL_MS pada stream service tetap menjadi fallback, sehingga
     * konsistensi akhir selalu terjaga.
     *
     * @param  int  $cameraId  id kamera yang berubah
     * @param  string  $action  ACTION_CREATED | ACTION_UPDATED | ACTION_DELETED
     */
    public function cameraChanged(int $cameraId, string $action): void
    {
        if ($this->url === '' || !in_array($action, [
            self::ACTION_CREATED,
            self::ACTION_UPDATED,
            self::ACTION_DELETED,
        ], true)) {
            return;
        }

        try {
            Http::timeout(2)
                ->withToken($this->token)
                ->post(rtrim($this->url, '/') . '/sync', [
                    'type' => 'camera.changed',
                    'id' => $cameraId,
                    'action' => $action,
                ]);
        } catch (Throwable) {
            // Fail-silent: stream service tetap sinkron via polling berkala.
        }
    }
}
