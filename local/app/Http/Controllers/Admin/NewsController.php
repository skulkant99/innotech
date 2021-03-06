<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['main_menu'] = 'GroupMenu';
        $data['sub_menu'] = 'News';
        $data['title'] = 'เรื่องน่ารู้เกี่ยวกับการลงทุน';
        $data['title_page'] = 'เรื่องน่ารู้เกี่ยวกับการลงทุน';
        $data['menus'] = \App\Models\AdminMenu::ActiveMenu()->get();
        
        return view('Admin.news',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input_all = $request->all();
        $file_name = [];

            if(isset($input_all['photo'])){
                foreach($input_all['photo'] as $key=>$val){
                    //$input_all['photo'] = $input_all['photo'][$key];
                    if(Storage::disk("uploads")->exists("temp/".$input_all['photo'][$key])&&!Storage::disk("uploads")->exists("News/".$input_all['photo'][$key])){
                        Storage::disk("uploads")->copy("temp/".$input_all['photo'][$key],"News/".$input_all['photo'][$key]);
                        Storage::disk("uploads")->delete("temp/".$input_all['photo'][$key]);
                        $file_name[] = $input_all['photo'][$key];
                    }
                }
            }
            $input_all['photo'] = json_encode($file_name);
    
        $input_all['status'] = $request->input('status','2');
        if(isset($input_all['sort_id'])){
            $input_all['sort_id'] = str_replace(',', '', $input_all['sort_id']);
        }
        
        $input_all['created_at'] = date('Y-m-d H:i:s');
        $input_all['updated_at'] = date('Y-m-d H:i:s');

        $validator = Validator::make($request->all(), [
            'title_th' => 'required',
             
             
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = $input_all;
                \App\Models\News::insert($data_insert);
                \DB::commit();
                $return['status'] = 1;
                $return['content'] = 'สำเร็จ';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'ไม่สำเร็จ'.$e->getMessage();
            }
        }else{
            $return['status'] = 0;
        }
        $return['title'] = 'เพิ่มข้อมูล';
        return json_encode($return);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = \App\Models\News::find($id);
        
            if($result){
                if($result->photo){
                    $photos = json_decode($result->photo);
                    if(sizeof($photos) > 0){
                        foreach($photos as $photo){
                            if(Storage::disk("uploads")->exists("News/".$photo)){
                                if(Storage::disk("uploads")->exists("temp/".$photo)){
                                    Storage::disk("uploads")->delete("temp/".$photo);
                                }
                                Storage::disk("uploads")->copy("News/".$photo,"temp/".$photo);
                            }
                        }
                    }
                }
            }
        
        return json_encode($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input_all = $request->all();
        
            $file_name = [];
            if(isset($input_all['photo'])){
                //$input_all['photo'] = $input_all['photo'][0];
                //unset($input_all['org_photo']);
                foreach($input_all['photo'] as $key=>$val){
                    if(Storage::disk("uploads")->exists("temp/".$input_all['photo'][$key])&&!Storage::disk("uploads")->exists("News/".$input_all['photo'][$key])){
                        Storage::disk("uploads")->copy("temp/".$input_all['photo'][$key],"News/".$input_all['photo'][$key]);
                        Storage::disk("uploads")->delete("temp/".$input_all['photo'][$key]);
                    }
                    $file_name[] = $input_all['photo'][$key];
                }
            }
            if(isset($input_all['org_photo'])){
                Storage::disk("uploads")->delete("temp/".$input_all['org_photo']);
            }
            unset($input_all['org_photo']);
            $input_all['photo'] = json_encode($file_name);

            $input_all['status'] = $request->input('status','2');
            if(isset($input_all['sort_id'])){
                $input_all['sort_id'] = str_replace(',', '', $input_all['sort_id']);
            }
        
        $input_all['updated_at'] = date('Y-m-d H:i:s');

        $validator = Validator::make($request->all(), [
            'title_th' => 'required',
            
             
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = $input_all;
                \App\Models\News::where('id',$id)->update($data_insert);
                \DB::commit();
                $return['status'] = 1;
                $return['content'] = 'สำเร็จ';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'ไม่สำเร็จ'.$e->getMessage();
            }
        }else{
            $return['status'] = 0;
        }
        $return['title'] = 'เพิ่มข้อมูล';
        return json_encode($return);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \DB::beginTransaction();
        try {
            \App\Models\News::where('id',$id)->delete();
            \DB::commit();
            $return['status'] = 1;
            $return['content'] = 'สำเร็จ';
        } catch (Exception $e) {
            \DB::rollBack();
            $return['status'] = 0;
            $return['content'] = 'ไม่สำเร็จ'.$e->getMessage();
        }
        $return['title'] = 'ลบข้อมูล';
        return $return;
    }

    public function Lists(){
        $result = \App\Models\News::select()->orderBy('sort_id','ASC');
        return \Datatables::of($result)
        ->addIndexColumn()
        
        ->addColumn('sort_id',function($rec){
            if(is_numeric($rec->sort_id)){
                return number_format($rec->sort_id);
            }else{
                return $rec->sort_id;
            }
        })
        ->editColumn('status',function($rec){
            if($rec->status == 1){
                return $status = '<span class="badge badge-success">เปิดใช้งาน</span>';
            }else {
                return $status = '<span class="badge badge-danger">ปิดใช้งาน</span>';
            }
        })
        ->editColumn('photo',function($rec){
            if($rec->photo == null){
                return $photo = ' <img src="'.asset('uploads/News/nophoto.png').'" class="image-full image-btn" width="50%" height="50%" alt="innothect"/>';
            }else {
                foreach(json_decode($rec->photo) as $rec->photo){
                    return $photo = ' <img src="'.asset('uploads/News/'.$rec->photo).'" class="image-full image-btn" width="50%" height="50%" alt="innothect"/>';
                    break;
                }
            }
        }) 
        
        ->addColumn('action',function($rec){
            $str='
            <a href="#" class="btn btn-simple btn-warning btn-icon edit btn-edit btn-tooltip" data-rel="tooltip" data-id="'.$rec->id.'" title="แก้ไข"><i class="ti-pencil-alt"></i></a>
            <a href="#" class="btn btn-simple btn-danger btn-icon remove  btn-delete btn-tooltip"  data-id="'.$rec->id.'" data-rel="tooltip" title="ลบ"><i class="ti-close"></i></a>
            ';
            return $str;
        })->make(true);
    }

}
