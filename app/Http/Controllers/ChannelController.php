<?php

namespace App\Http\Controllers;

use App\Imports\ChannelImport;
use App\Models\Channel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ChannelController extends Controller
{
    public function index(Request $request)
    {
        $channels = Channel::paginate(10);
        if ($request->has('search')) {
            $channels = Channel::where("nama", 'like', "%" . $request->search . "%")->paginate(10);
        }

        return view('pages.channel.index', compact('channels'));
    }
    public function destroy(Request $request, Channel $channel)
    {
        $channel->delete();
        return redirect()->route('channel-index')->with('success', 'Channel berhasil dihapus');
    }
    public function store(Request $request)
    {
        $attr = $request->validate([
            "id" => "required|unique:dw_dim_channels,id",
            "nama" => "required|unique:dw_dim_channels,nama",
        ]);

        Channel::create($attr);
        return redirect()->route('channel-index')->with('success', 'Channel berhasil ditambahkan');
    }
    public function edit(Request $request, Channel $channel)
    {
        return view('pages.channel.edit', compact('channel'));
    }
    public function update(Request $request, Channel $channel)
    {
        $attr = $request->validate([
            "id" => "nullable",
            "nama" => "nullable",
            "type" => "nullable",
            "price" => "nullable|integer"
        ]);

        $channel->update($attr);
        return redirect()->route('channel-index')->with('success', 'Channel berhasil diubah');
    }
    public function import(Request $request)
    {
        Excel::import(new ChannelImport, $request->file("file"));
        return redirect()->route("channel-index")->with('success', 'Berhasil menginport data');
    }
}
