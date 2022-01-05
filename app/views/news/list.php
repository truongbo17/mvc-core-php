<h1>Danh sach tin tuc</h1>
{{ $new_title }}
<br>
{{ $new_content  }}
<br>
{{ 'truongbo'}}
<br>
{{toSlug('tieu de bai viet')}}
<br>	
{! $new_abc !}
<br>	
{{!empty($page) ? 'co page' : 'khong page'}}
<br>	
{{md5(1241234)}}
<br>
<br>	
@if(!empty($new_auth))
<p>Ten tac gia {{$new_auth}}</p>
@else
<p>	khong co gi</p>
@endif

<br>	
@if(md5(342344) != '')
<h4>MD5 {{md5(342344)}}</h4>
@endif

@php
$y = 0;
$number = 10;

$data = [
		'item 1',
		'item 1ew',
		'item 1eq',
		'item 1q'
]
@endphp

{{++$number}}
<br>
@for($i = 0;$i < count($data); $i++)
<p>{{$data[$i]}}</p>
@endfor

<br>	
@while($y < 10)
<p>{{$y}}</p>

@php
$y++;
@endphp

@endwhile



@foreach($data as $value)
		<p>{{$value}}</p>
@endforeach

