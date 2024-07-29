@extends('admin.layout.main')

<style>
    .ms-options {
    padding: 20px;
    border: none; }

    .ms-options-wrap > button:focus, .ms-options-wrap > button {
    border-radius: 4px;
    -webkit-transition: .3s all ease;
    -o-transition: .3s all ease;
    transition: .3s all ease;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    border: none !important;
    height: 40px;
    padding-left: 10px;
    padding-right: 10px;
    z-index: 2; }
    .ms-options-wrap > button:focus:hover, .ms-options-wrap > button:hover {
        -webkit-box-shadow: 0 2px 10px 0 rgba(0, 0, 0, 0.1);
        box-shadow: 0 2px 10px 0 rgba(0, 0, 0, 0.1); }
    .ms-options-wrap > button:focus:after, .ms-options-wrap > button:after {
        right: 10px; }
    .ms-options-wrap > button:focus:active, .ms-options-wrap > button:focus:focus, .ms-options-wrap > button:active, .ms-options-wrap > button:focus {
        outline: none; }

    .ms-options-wrap.ms-active > button:focus, .ms-options-wrap.ms-active > button {
    -webkit-box-shadow: 0 2px 10px 0 rgba(0, 0, 0, 0.1);
    box-shadow: 0 2px 10px 0 rgba(0, 0, 0, 0.1); }

    .ms-options-wrap > .ms-options {
    z-index: 1;
    margin-top: 12px;
    border: none !important;
    -webkit-box-shadow: 0 15px 30px 0 rgba(0, 0, 0, 0.1);
    box-shadow: 0 15px 30px 0 rgba(0, 0, 0, 0.1);
    border-radius: 4px; }
    .ms-options-wrap > .ms-options .ms-search input {
        border-bottom: 1px solid #efefef; }
    .ms-options-wrap > .ms-options .ms-selectall {
        color: #aaaaaa;
        text-transform: uppercase;
        font-size: 11px; }
        .ms-options-wrap > .ms-options .ms-selectall:hover {
        color: #000; }
    .ms-options-wrap > .ms-options > ul li.selected label {
        border-radius: 4px;
        background: #e1f2fb; }
    .ms-options-wrap > .ms-options > ul li label {
        border-radius: 4px;
        border: none;
        padding-top: 5px;
        padding-bottom: 5px; }
    .ms-options-wrap > .ms-options > ul li:hover label {
        border: none;
        background: #f7f7f7; }
</style>
@section('content')
<div class="card col-md-8 offset-md-2">
    <div class="card-body">
        <h1>Create Alternative</h1>
        <form action="{{ route('alternatives.store') }}" method="POST" id="alternativeForm">
            @csrf
            <div class="form-group">
                <label for="hotel_selection_type">Select Type:</label>
                <select name="hotel_selection_type" id="hotel_selection_type" class="form-select mb-3">
                    <option value="multiple">Multiple Selection</option>
                    <option value="single">Single Selection</option>
                </select>
            </div>
            <div id="singleSelection" style="display: none;">
                <div class="form-group">
                    <label for="hotel_id_single">Select Hotel:</label>
                    <select name="hotel_id_single" id="hotel_id_single" class="form-select mb-3">
                        @foreach($hotels as $hotel)
                            @if (!in_array($hotel->id, $existingAlternatives))
                                <option value="{{ $hotel->id }}">{{ $hotel->nama }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="multipleSelection">
                <div class="form-group mb-3">
                    <label for="hotel_id_single">Select Hotel:</label>
                    <select name="hotel_id[]" id="hotel_id" class="3col active form-control" multiple="multiple">
                        @foreach($hotels as $hotel)
                            @if (!in_array($hotel->id, $existingAlternatives))
                                <option value="{{ $hotel->id }}">{{ $hotel->nama }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>


@section('script')
$(function() {
    $('select[multiple].active.3col').multiselect({
    columns: 3,
    placeholder: 'Select Hotel',
    search: true,
    searchOptions: {
        'default': 'Search Hotel'
    },
    selectAll: true
        });
});

document.getElementById('hotel_selection_type').addEventListener('change', function() {
var selectionType = this.value;
if (selectionType === 'single') {
    document.getElementById('singleSelection').style.display = 'inline';
    document.getElementById('multipleSelection').style.display = 'none';
} else if (selectionType === 'multiple') {
    document.getElementById('singleSelection').style.display = 'none';
    document.getElementById('multipleSelection').style.display = 'inline';
}
});
@endsection
@endsection
