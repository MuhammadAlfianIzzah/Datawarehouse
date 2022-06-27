<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function index()
    {
        $channels = Channel::paginate(10);
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
}
