@extends('layouts.admin_layout')

@section('title')
Admin-Main page settings
@stop

@section('body')
<h1>Admin Section</h1>
@stop

@section('itemsi')

<h2 class="sub-header">Main page setup</h2>


    
@foreach ($mpobjects as $mpobject)

@if ($mpobject->record_type==3)
  <?php 
    if (!isset($count))
    {
      $count=1;
      echo "<div class='row'>";
    } 
    else 
    {
      if ($count<3) 
      {
        $count++;
      }
    }

  ?>
{!!Form::open([
                        'id'=>'upload' . $mpobject->id,
                        'method'=>'POST',
                        'files' => true,
                        'class' => 'ajax',
                        'route'=>['admin.main-page.ajax', $mpobject->id]
                        ])!!}
  <div class="col-md-4">
 <div class="panel panel-default">
            <div class="panel-heading panel-heading-custom">
               <h3 class="panel-title">Heading {{ $count }}</h3>
            </div>
            <div class="panel-body">
              <div class="well">
                <div id="image{{  $mpobject->id }}">
                {{ Html::image('../../images/' . $mpobject->filename . '?w=110&h=110&fit=crop', 'picture', ['class'=>'responcive img-rounded'])}}</div>
               {{ Form::input('file', 'imag', null, ['id'=>'file' . $mpobject->id])}}
                {{ Form::input('hidden', 'id', $mpobject->id) }}
              </div>
              <div class="well">
                {{ Form::text('caption', $mpobject->caption, ['class'=>'form-control']) }}
              </div>
              <div class="well">
                {{ Form::textarea('info', $mpobject->info, ['class'=>'form-control']) }}
              </div>
              
            </div>
            <div class="panel-footer">
            {{ Form::submit('Update', ['class'=>'btn btn-default']) }}
            </div>
         </div>
  </div>
  {{ Form::close()}}
  <?php 
    if ($count==3) {

      unset($count);
      echo "</div>";
    }
    
  ?>

@endif

@if ($mpobject->record_type==4)
  <?php 
    if (!isset($count))
    {
      $count=1;
      echo "<div class='row'>";
    } 
    else 
    {
      if ($count<3) 
      {
        $count++;
      }
    }

  ?>
{!!Form::open([
                        'id'=>'upload' . $mpobject->id,
                        'method'=>'POST',
                        'files' => true,
                        'class' => 'ajax',
                        'route'=>['admin.main-page.ajax', $mpobject->id]
                        ])!!}
  <div class="col-md-4">
 <div class="panel panel-default">
            <div class="panel-heading panel-heading-custom">
               <h3 class="panel-title">Explanation {{ $count }}</h3>
            </div>
            <div class="panel-body">
              <div class="well">
                <div id="image{{  $mpobject->id }}">
                {{ Html::image('../../images/' . $mpobject->filename . '?w=110&h=110&fit=crop', 'picture', ['class'=>'responcive img-rounded'])}}</div>
                {{ Form::input('file', 'imag', null, ['id'=>'file' . $mpobject->id])}}
                {{ Form::input('hidden', 'id', $mpobject->id) }}
              </div>
              <div class="well">
                {{ Form::text('caption', $mpobject->caption, ['class'=>'form-control']) }}
              </div>
              <div class="well">
                {{ Form::textarea('info', $mpobject->info, ['class'=>'form-control']) }}
              </div>
              
            </div>
            <div class="panel-footer">
            {{ Form::submit('Update', ['class'=>'btn btn-default']) }}
            </div>
         </div>
  </div>
  {{Form::close()}}
  <?php 
    if ($count==3) {

      unset($count);
      echo "</div>";
    }
    
  ?>
@endif  


@if ($mpobject->record_type==2)
  <?php 
    if (!isset($count))
    {
      $count=1;
      echo "<div class='row'>";
    } 
    else 
    {
      if ($count<3) 
      {
        $count++;
      }
    }

  ?>
{!!Form::open([
                        'id'=>'upload' . $mpobject->id,
                        'method'=>'POST',
                        'files' => true,
                        'class' => 'ajax',
                        'route'=>['admin.main-page.ajax', $mpobject->id]
                        ])!!}
  <div class="col-md-12">
 <div class="panel panel-default">
            <div class="panel-heading panel-heading-custom">
               <h3 class="panel-title">Slide {{ $count }} </h3>
            </div>
            <div class="panel-body">
              <div class="well">
                <div id="image{{  $mpobject->id }}">
                {{ Html::image('../../images/' . $mpobject->filename . '?w=210&h=110&fit=crop', 'picture', ['class'=>'responcive img-rounded'])}}</div>
                {{ Form::input('file', 'imag', null, ['id'=>'file' . $mpobject->id])}}
                {{ Form::input('hidden', 'id', $mpobject->id) }}
              </div>
              <div class="well">
                {{ Form::text('caption', $mpobject->caption, ['class'=>'form-control']) }}
              </div>
              <div class="well">
                {{ Form::textarea('info', $mpobject->info, ['class'=>'form-control', 'rows'=>'2']) }}
              </div>
              
            </div>
            <div class="panel-footer">
            {{ Form::submit('Update', ['class'=>'btn btn-default']) }}
            </div>
         </div>
  </div>
  {{ Form::close()}}
  <?php 
    if ($count==3) {

      unset($count);
      echo "</div>";
    }
    
  ?>
@endif  


@endforeach

</div>


      
          {{ base_path() }}
@stop
@section('scripts')
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
        $('form.ajax').on('submit', function(event){
            event.preventDefault();
            var filedata = new FormData();
            var f1 = $(this).find('input[type=file]')[0].files[0];
            filedata.append('imag', f1);
            filedata.append('caption', $(this).find('input[name="caption"]').val());
            filedata.append('info', $(this).find('textarea[name="info"]').val());
            filedata.append('id', $(this).find('input[name="id"]').val());

            

            if (f1) {
            var imagTarget = "image"+$(this).find('input[name="id"]').val();
            };

            $.ajax({
                type     : "POST",
                url      : $(this).attr('action'),
                data     : filedata,
                cache    : false,
                contentType: false,
                processData: false,
                success  : function(data) {
                
                  if (imagTarget)
                  {
                    document.getElementById(imagTarget).innerHTML = "<img src='../../images/"+data[1]+"?w=210&amp;h=110&amp;fit=crop' class='responcive img-rounded' id='"+imagTarget+"' alt='picture'>";
                  }

                    document.getElementById("ajax-response").innerHTML = data[0];

                    $( "#ajax-response" ).dialog({
                      modal: true,
                      text: "Ok",
                       show: { effect: "blind", duration: 800 },
                       buttons: {
                    Ok: function() {
                    $( this ).dialog( "close" );
                 }
            }
    });
                }
            })

            return false;

        });


   



@stop