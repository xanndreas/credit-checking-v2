<p style="text-align: right;">SURVEY REPORT (INTERNAL)</p>
<p style="text-align: right;">Requested : {{ $surveyReport->survey_address->created_at }} </p>
<p style="text-align: right;">Report : {{ $surveyReport->created_at }} </p>
<p><br></p>
<p>{{ $surveyReport->surveyor->name ?? 'Surveyor' }}</p>
<p style="margin-left: 20px;">1. &nbsp;Alamat Survey:</p>

@foreach($surveyReport->survey_attributes->filter(function ($row) { return $row->object_name == 'survey_address'; }) as $items)
    <p style="margin-left: 40px;">- &nbsp;{{$items->attribute}}: {{$items->attribute_2}}</p>
@endforeach

<p style="margin-left: 20px;">2. &nbsp;Akses Jalan dan Parkir
    &nbsp;&mdash; {{ $surveyReport->survey_attributes->filter(function ($row) { return $row->object_name == 'parking_access'; })->first()->attribute ?? '' }}
    &nbsp;</p>

<p style="margin-left: 20px;">3. &nbsp;Status Kepemilikan &nbsp;&mdash; {{ $surveyReport->survey_attributes->filter(function ($row) { return $row->object_name == 'owner_status'; })->first()->attribute ?? '' }}</p>
<p style="margin-left: 20px;">4. &nbsp;Beneficial Owner (Purpose)
    &nbsp;&mdash; {{ $surveyReport->survey_attributes->filter(function ($row) { return $row->object_name == 'owner_beneficial'; })->first()->attribute ?? '' }}</p>

<p style="margin-left: 20px;">5. &nbsp;Document yang Ditunjukan:</p>
@foreach($surveyReport->survey_attributes->filter(function ($row) { return $row->object_name == 'document_attachment'; }) as $items)
    <p style="margin-left: 40px;">- &nbsp;{{$items->attribute}}: {{$items->attribute_2}}</p>
@endforeach

<p style="margin-left: 20px;">6. &nbsp;Cek Lingkungan:</p>
@foreach($surveyReport->survey_attributes->filter(function ($row) { return $row->object_name == 'environmental_check'; }) as $items)
    <p style="margin-left: 40px;">- &nbsp;{{$items->attribute}}: {{$items->attribute_2}}</p>
@endforeach

<p style="margin-left: 20px;">7. &nbsp;Tempat Bekerja &nbsp;&mdash; {{ $surveyReport->survey_attributes->filter(function ($row) { return $row->object_name == 'office_note'; })->first()->attribute ?? '' }}</p>
<p style="margin-left: 20px;"><br></p>
<p style="margin-left: 20px;">Note:</p>

@foreach($surveyReport->survey_attributes->filter(function ($row) { return $row->object_name == 'note'; }) as $items)
    <p style="margin-left: 40px;">- &nbsp;{{$items->attribute}}</p>
@endforeach

<p style="margin-left: 20px;"><br></p>
<p style="margin-left: 20px;">Data Kurang:</p>

@foreach($surveyReport->survey_attributes->filter(function ($row) { return $row->object_name == 'incomplete_document'; }) as $items)
    <p style="margin-left: 40px;">- &nbsp;{{$items->attribute}}: {{$items->attribute_2}}</p>
@endforeach

<p style="margin-left: 20px;"><br></p>
<p style="margin-left: 20px;">Lampiran Gambar:</p>

@if($surveyReport->attachments)
    @foreach($surveyReport->attachments as $items)
        <p style="margin-left: 40px;">- &nbsp; {{ $items->getUrl() }}</p>
    @endforeach
@endif
