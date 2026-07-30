export function createPool({ maxConcurrency, onAcquire, onRelease }) {
  let max = Math.max(1, maxConcurrency | 0);
  const active = new Set();
  const pending = new Map();

  function drain() {
    while (active.size < max && pending.size > 0) {
      const [id, cam] = pending.entries().next().value;
      pending.delete(id);
      active.add(id);
      onAcquire(cam);
    }
  }

  return {
    request(cam) {
      const id = cam.id;
      if (active.has(id) || pending.has(id)) return "duplicate";
      if (active.size < max) {
        active.add(id);
        onAcquire(cam);
        return "acquired";
      }
      pending.set(id, cam);
      return "queued";
    },
    release(id) {
      const wasActive = active.delete(id);
      pending.delete(id);
      onRelease?.(id);
      drain();
      return wasActive;
    },
    setMax(n) {
      max = Math.max(1, n | 0);
      drain();
    },
    activeCount: () => active.size,
    pendingCount: () => pending.size,
    isActive: (id) => active.has(id) || pending.has(id),
    activeIds: () => [...active],
    pendingIds: () => [...pending.keys()],
  };
}
