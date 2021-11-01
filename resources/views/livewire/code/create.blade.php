<div>
    <h1 class='text-center'>CodeStart Make</h1>
    <div class="row">
        <div class="col-12">
            @error('name') <div class="alert alert-danger mx-5"> {{ $message }} </div> @enderror
        </div>
        <!-- col-4 -->
        <div class="col-4 py-4 bg-secondary text-white ">

            <div class="row  mx-1">
                <label for="getCode" class='form-label col-3'>الكود</label>

                <select wire:model='codeType' wire:change="getCode" class="custom-select custom-select-md mb-3 col-9">
                    <option selected>اختر</option>
                    <option>عرض_الكل</option>
                    <option>عرض</option>
                    <option>الاضافة</option>
                    <option>تعديل</option>
                    <option>بناء_الجدول</option>
                    <option>كود_الجدول</option>

                </select>


            <div class="row">
                <div class=" wire: mx-2 col-5">
                    <label for="" class='form-label   '>الجدول</label>
                    <input type="text" class='form-control  ' id='name' wire:model='name'>
                </div>
                <div class="  mx-2 col-5">
                    <label for="" class='form-label   '>الاب</label>
                    <input type="text" class='form-control  ' id='tableFk' wire:model='tableFk'>
                </div>

            <div class=" row   ">
                <div class="row mx-2 mt-2 col-4">
                    <label for="" class='form-label  '>العمود</label>
                    <input type="text" class='form-control  ' id='col_name' wire:model='col_name'>

                </div>
                <div class="row mt-2   col-4">
                    <label for="" class='form-label  '>نوع</label>
                    <select wire:model='col_type' wire:change="" class="custom-select custom-select-md  ">
                        <option selected>اختر</option>
                        @foreach ($colsDataTypes as $colsDataType)
                        <option>{{$colsDataType}}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-check col-4 pt-5 mx-1">
                    <input wire:model='null'    class="form-check-input" type="checkbox" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        NULL
                    </label>
                </div>
            </div>
        </div>


        <div class="col-12">
            <table class="table table-hover table-dark table-small text-center mt-2">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">type</th>
                        <th scope="col">null</th>

                    </tr>
                </thead>
                <tbody>
                    {{-- {{dd($cols)}} --}}


                    @for($i = 0; $i < count($cols) ;$i++) 
                    <tr>
                        <th scope="row">{{$cols [$i]['id']}}</th>
                        <td>{{$cols [$i]['name'] }}</td>
                        <td>{{$cols [$i]['type'] }}</td>
                        <td>{{$cols [$i]['null'] }}</td>

                        </tr>

                        @endfor
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- col-8 -->
<div class="col-8">

    <form wire:submit.prevent="getCode">

        <div class="form-floating">
            <textarea wire:model="code" class="form-control  " placeholder="Leave a comment here" id="floatingTextarea2"
                style="height: 200px;color:black;font-size:1.2em;"></textarea>
            <label for="floatingTextarea2">Code</label>
        </div>


        {{-- <button type="submit" class='btn btn-info'>Make</button> --}}
        <button type="button" onclick="Copy()" class='btn btn-success'>نسخ وتفريغ</button>
        <button type="button" wire:click.prevent="addCol" class='btn btn-success'>col </button>
        {{-- <button type="button" onclick="Copy()" class='btn btn-danger'>Copy</button> --}}
    </form>

</div>

</div>

</div>
<script>
    function Copy() {
/* Get the text field */
var copyText = document.getElementById("floatingTextarea2");

/* Select the text field */
copyText.select();
copyText.setSelectionRange(0, 99999); /* For mobile devices */

/* Copy the text inside the text field */
navigator.clipboard.writeText(copyText.value);

/* Alert the copied text */
 document.querySelector('form').reset();
 document.querySelector('select').value='اختر';
 document.querySelector('#name').value='';
}

</script>
