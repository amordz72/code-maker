<div>
    <h1 class='text-center'>النسخ الاحتياطية</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="box bg-light">
                <hr>
                <div class="box-header with-borde d-flex ">
                    {{-- <a href="{{ route('backups.create') }}" class="btn btn-danger mx-auto"
                        style="width: 200px; ;">أنشاء
                        نسخة أحتياطية للكل</a> --}}
                    <button wire:click='create' class="btn btn-danger mx-auto font-weight-bold"
                        style="width: 200px; ;">أنشاء
                        نسخة أحتياطية للكل</button>


                    <button wire:click='bk_onlyDb' class="btn btn-info   mx-auto font-weight-bold"
                        style="width: 200px; ;">أنشاء
                        نسخة لقاعدة بيانات</button>

                    <button wire:click='bk_onlyFiles' class="btn btn-secondary   mx-auto font-weight-bold"
                        style="width: 200px; ;">أنشاء نسخة للملفات</button>





                </div><!-- /.box-header -->

                {{-- {{dd($backups)}} --}}

                <hr>

                <div class="box-body">
                    @if (count($files)>0)
                    <div class="container">
                        <table class="table table-bordered text-center font-weight-bold">
                            <thead class="table-dark">
                                <tr>
                                    <th>الملف</th>
                                    <th>الحجم</th>
                                    <th>التاريخ</th>
                                    {{-- <th>المدة</th> --}}
                                    <th>الاوامر</th>
                                </tr>
                            </thead>
                            <tbody>

                                @for($i = 0; $i < count($files) ;$i++) <tr>

                                    <td>{{$files [$i]['filename'] }}</td>
                                    <td>{{$files [$i]['filesize'] }} </td>
                                    <td>{{$files [$i]['filemtime'] }}</td>
                                    <td hidden>{{$files [$i]['url'] }}</td>
                                    <td class="text-right">
                                        <a class="btn btn-xs btn-info"
                                            href="{{ route('backups.download', $files [$i]['filename']) }}"><i
                                                class="fa fa-cloud-download"></i> تحميل</a>


                                        <a class="btn btn-xs btn-danger" data-button-type="delete"
                                            href="{{ route('backups.delete', $files [$i]['filename']) }}"><i
                                                class="fa fa-trash-o"></i>
                                            حذف</a>
                                    </td>

                                    </tr>

                                    @endfor

                            </tbody>
                            @else
                            <tr>


                                <td colspan="4"><b>لا توجد نسخ احتياطية</b></td>
                            </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div>
</div>