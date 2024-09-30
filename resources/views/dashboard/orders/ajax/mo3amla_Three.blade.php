
<h4> ارسال لمعقبين / مكاتب خدمات محددين </h4>

<input type="hidden" name="order_id" value="{{ $order->id }}">
<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
<thead>
    <tr>
        <th>#</th>
        <th>رقم الحساب</th>
        <th>الاسم</th>
        <th>الجوال</th>
        <th>نوع الحساب</th>
        <th>حالة الحساب</th>
    </tr>
</thead>
<tbody>
    @foreach ($vendors as $index => $user)
        
    <tr>
        <td>
            <input type="checkbox" class="ids" name="user_id" value="{{ $user->id }}">
        </td>
        <td>{{ $user->id }}</td>
        <td>
            <a target="_blank" href="{{ route('dashboard.users.client_show', ['id' => $user->id ]) }}">
                {{ $user->name }}
            </a>
        </td>
        <td>{{ $user->phone }}</td>
        <td>
            @if($user->type == 'vendor')
                معقب
            @elseif($user->type == 'vendorC')
                مكتب خدمات
            @endif
        </td>
        <td>
            @if($user->status == 0 ) 
                جديد
            @elseif($user->status == 1 ) 
                <span style="color:green">  نشط</span>
            @elseif($user->status == -1 ) 
                <span style="color:red">   موقوف</span>
            @elseif($user->status == -2 ) 
                <span style="color:black">  القائمة السوداء</span>
            @else
                {{ $user->status }}
            @endif
            
        </td>
    </tr>

    @endforeach
</tbody>
</table>
<div class="m-form__actions m-form__actions--solid">
    <div class="row">
        <div class="col-lg-9"></div>
        <div class="col-lg-3">
            <button type="submit" class="btn btn-accent push-left" onclick="getValueUsingClass()">ارسال</button>
        </div>
    </div>
</div>

<input type="hidden" name="ids_input" id="12121212">

<script>
    function getValueUsingClass(){
        
        /* declare an checkbox array */
        var ids = [];
        
        /* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
        $(".ids:checked").each(function() {
            ids.push($(this).val());
        });
        
        /* we join the array separated by the comma */
        var selected;
        selected = ids.join(',') ;

        $('#12121212').val(selected);

    }
</script>