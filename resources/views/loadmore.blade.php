@extends('layouts.app')

@section('js')
<script>


var page = 1; 
load_more(page); 


$(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() >= $(document).height()) {
        page++; 
        load_more(page);
    }
});

// ajax
function load_more(page){
    $.ajax(
    {
        url: '?page=' + page,
        type: "get",
        datatype: "html",
        beforeSend: function()
        {
            $('.ajax-loading').show();
        }
    })
    .done(function(data)
    {
        
        if(data.length == 0){
            $('.ajax-loading').html("No more records!");
            return;
        }

        
        $('.ajax-loading').hide(); //hide loading animation once data is received
        $("#results").append(data); //append data into #results element
    })
    .fail(function(jqXHR, ajaxOptions, thrownError)
    {
        alert('No response from server');
    });
}
</script>
@endsection

@section('content')
<style>
.wrapper > ul#results li {
  margin-bottom: 1px;
  background: #f9f9f9;
  padding: 20px;
  list-style: none;
}
.ajax-loading{
  text-align: center;
}
</style>
<div class="wrapper">
    <ul id="results">{{-- Load More--}}</ul>
    <div class="ajax-loading"><img src="http://demo.expertphp.in/images/loading.gif" /></div>
</div>
@endsection
