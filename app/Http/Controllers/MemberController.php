<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorememberRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdatememberRequest;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function member()
    {
        $members = Member::all();
        return view('member', compact('members'));
    }

    // public function getHitung($data)
    // {
    //     dd($data->toArray());

    //     $hitung = 1;

    //     if ($data->childrens != null) {
    //         $tmpHitung = 1;
    //         foreach ($data->childrens as $child) {
    //             if ($child->childrens) $tmpHitung += $this->getHitung($child);
    //             else $tmpHitung += 1;

    //             if ($tmpHitung > $hitung) $hitung = $tmpHitung;
    //         }
    //     }

    //     // $hasil = ($data->childrens != null ? self::getHitung($data->childrens) : 0);

    //     return $hitung;
    // }

    public function getLevel($data)
    {
        $level = 1;

        if ($data->parent != null) {
            $level += $this->getLevel($data->parent);
        }
        
        return $level;
    }

    public function getBonus($data)
    {
        $satu = $data->count() * 1;
        $setengah = 0;
        foreach ($data as $child) {
            $setengah += $child->children->count();
        }
        $setengah = $setengah * 0.5;
        $hasil  = $satu + $setengah;
        return $hasil;
    }
    
    public function bonus()
    {
        $members = Member::all();
        return view('bonus', compact('members'));
    }
    public function migrasi()
    {
        $members = Member::all();
        return view('migrasi', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = Member::all();
        return view('form', compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorememberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'member_id' => 'required',
            'name' => 'required'
        ]);


        $post = Member::create([
            'member_id' => $request->member_id,
            'parent_id' => $request->parent_id,
            'name' => $request->name,
        ]);

        if ($post) {
            return redirect()
                ->route('member')
                ->with([
                    'success' => 'New post has been created successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'parent_id' => 'required',
        ]);

        $members = Member::all();
        if ($validator->fails())
            return view('bonus', compact('members'));

        $id = $request->parent_id;
        $parents = Member::with('parents')->where('id', $id)->first();
        $childrens = Member::with('children')->where('parent_id', $id)->get();
        $parents->level = $this->getLevel($parents);
        $parents->bonus = $this->getBonus($childrens);
        return view('bonus', compact('members', 'parents'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Member::where('id', $id)->first();
        $members = Member::where('id','!=', $id)->get();
        return view('edit', compact('members', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatememberRequest  $request
     * @param  \App\Models\member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Member::where('id',$id);
        $id = $request->parent_id;
        $parents = Member::with('parents')->where('id', $id)->first();
        $post->update([
            'parent_id' => $request->parent_id,
        ]);
        return redirect()
                ->route('migrasi')
                ->with([
                    'success' => 'Migrasi successfully'
                ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(member $member)
    {
        //
    }
}
