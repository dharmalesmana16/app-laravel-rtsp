<?php

namespace App\Http\Controllers;

use App\Models\DataCamera;
use App\Models\DataVendor;
use Illuminate\Http\Request;

class DataCameraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $data;
    public function __construct()
    {
        $this->data = new DataCamera();
    }
    public function index()
    {
        try {
            $data = $this->data::all();
            return response()->json([
                "msg" => "success",
                "data" => $data
            ]);
        } catch (\Exception $th) {
            return response()->json([
                "msg" => $th->getMessage()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            //code...
            $latestId = $this->data::latest()->value("id");

            $lastid = 1;
            if ($latestId == null) {
                $formatted = sprintf('%02d', $lastid);
            } else {
                $formatted = sprintf('%02d', $latestId);
            }
            $ip = $request->ip;
            $mac = $request->mac;
            $gateway = $request->gateway;
            $dns = $request->dns;
            $rtsp_port = 554;
            $http_port = 80 . $formatted;
            $auth_user = $request->auth_user;
            $auth_password = $request->auth_password;
            $lat = $request->lat;
            $long = $request->long;
            $channel = $request->channel;
            $url = "rtsp://" . $auth_user . ":" . $auth_password . "@" . $ip . ":" . $rtsp_port . `/cam/realmonitor?channel=$channel&subtype=1`;
            $tipe = $request->tipe;
            $brand = "EZVIZ";
            $id_vendor = $request->id_vendor;
            $id_kartu = $request->id_kartu;
            // streamUrl: 'rtsp://' + element["username"] + ':' + element["password"] + '@' + element["ip_address"] +`:554/cam/realmonitor?channel=${element["channel"]}&subtype=1`,

            $data = [
                "ip" => $ip,
                "mac" => $mac,
                "gateway" => $gateway,
                "dns" => $dns,
                "rtsp_port" => $rtsp_port,
                "http_port" => $http_port,
                "auth_user" => $auth_user,
                "auth_password" => $auth_password,
                "url" => $url,
                "lat" => $lat,
                "long" => $long,
                "tipe" => $tipe,
                "brand" => $brand,
                "id_vendor" => $id_vendor,
                "id_kartu" => $id_kartu,
                "channel" => $channel,
            ];
            $req = $this->data::create($data);
            if ($req) {
                return response()->json([
                    "msg" => "success",
                ]);
            }
        } catch (\Exception $th) {
            return response()->json([
                "msg" => $th->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
