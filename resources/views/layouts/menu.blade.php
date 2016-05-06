<ul>
<li><a href="http://localhost/laravel/Items/public/">Home</a></li>
<li><a href="http://localhost/laravel/Items/public/items">Items</a></li>
<li><a href="http://localhost/laravel/Items/public/admin">Admin</a></li>
</ul>
<div class="row">
	<div class="container text-center"><h3 >Dublin Core Data</h3>
	</div>
  		<div class="col-sm-12">

  			<div class="well">
  				<div id="tabs">
					<ul>
				  		<?php $count=0;?>
				  		@foreach ($dublin as $data)
				    		<li><a href="#tabs-{{ $count }}">{{ $data->element_id }}</a></li>
				  
				  			<?php $count++;?>
				  		@endforeach
				    
					</ul>
					<?php $count=0;?>
				  	@foreach ($dublin as $data)
  						<div id="tabs-{{ $count }}">
						    <p>
						{!!Form::textarea('subject', $data->text, ['rows' => '5', 'class' => 'form-control'])!!}<br></p>
						  </div>
						  <?php $count++;?>
					@endforeach


		</div>
</div>