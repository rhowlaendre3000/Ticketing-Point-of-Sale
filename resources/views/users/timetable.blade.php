@extends('layouts.app')

@section('content')

<div class="container-fluid">
	@if(session()->has('status'))
		<p class="alert alert-info">
			{{	session()->get('status') }}
		</p>
	@endif

	
	
	



 <div class="row">
       
	   
	   
 @if(Auth::user()->admin==1)
	   <div class="col-sm-3 col-sm-offset-3"> 
	  	
	  <div class="card">
	  <div class="card-header">
			  Add Venue,Date and Time
	  </div>
		  <div class="card-body">
			  
			  <form method="post" action="/timetable">
			  {{ csrf_field() }}
			 <div class="form-group">
<label for="course">Course</label><em>*</em>
<select type="text" name="course" class="form-control" id="course" required>
    @foreach($users->programme->course as $courses)
    <option> {{ $courses->coursetitle}} </option>
    @endforeach
</select>

</div>

<div class="form-group">
<label for="date">Date</label><em>*</em>
<input type="date" name="date" class="form-control" id="date" required>
</div>

<div class="form-group" style="">
<label for="time">Time</label><em>*</em>
<div class="row">
<div class="col-sm-5">
<input type="time" name="timefrom" class="form-control" id="timefrom" style="" required>
</div>
<div class="col-sm-2">to</div>
<div class="col-sm-5">
<input type="time" name="timeto" class="form-control" id="timeto" required>
</div>
</div>
</div>

<div class="form-group">
<label for="venue">Venue</label><em>*</em>
<input type="text" name="venue" class="form-control" id="venue" required>
</div>
<div class="form-group">
    <input type="submit" class="btn btn-success" value="submit">
</div>
			
			  </form>
				  
</div>	
		  </div>
		 
	</div>

	<div class="col-sm-9 col-sm-offset-3"> 
	<p>Programme Code : {{ $users->programme->initials }}</p>
<div class="card ">
		
<div class="card-header">
			
			  Timetable 
			  <h5> </h5>
			 
	  </div>
		<div class="card-body">
			
				<div class="table">
					<table class="table table-bordered">
						<thead>
							<tr>
								
								<th>Course</th>
								<th>Course Codes</th>
                                <th>Supervisor</th>
								<th>Time</th>
								<th>Venue</th>
								<th>Date</th>
							</tr>
						</thead>
						<tbody>

					
						
									
					
					
					
						@foreach($users->programme->course->where("level_id",'==', substr($users->programme->course->first()->coursecode,0,1)) as $user)
						
							<tr>
								
							
								
							
								
                                <td>{{$user->coursetitle}}</td>
                                <td>{{$user->coursecode}}</td>
								
								@isset($user->timetable->timefrom)
								<td>{{ $user->timetable->timefrom }} to {{$user->timetable->timeto}}</td>
								@endisset
								@isset($user->timetable->venue)
								<td> {{$user->timetable->venue}}</td>
								@endisset
								@isset($user->timetable->date)
								<td> {{$user->timetable->date}}</td>
								@endisset
									
							
							</tr>
							
							@endforeach
						</tbody>
					</table>
					
				</div>
				<div class="form-group">
    <a href="{{action('timetableController@pdf',$users->id)}}"> <input type="button" class="btn btn-success" value="Download"></a>
				</div>
				
				<div class="text-center">
				
				</div>
			
				
		
		</div>
	</div>
	
	@else
	
	<div class="col-sm-12 col-sm-offset-3"> 

<div class="card ">
		
<div class="card-header">
			  Timetable
	  </div>
		<div class="card-body">
			
				<div class="table">
					<table class="table table-bordered">
						<thead>
							<tr>
								
								<th>Course</th>
								<th>Course Codes</th>
                                <th>Lecturer</th>
								<th>Time</th>
								<th>Venue</th>
								<th>Date</th>
							</tr>
						</thead>
						<tbody>

					
						
									
					
					
					
						@foreach($users->programme->course->where("level_id",'==', substr($users->programme->course->last()->coursecode,0,1)) as $user)
						
							<tr>
								
							
								
							
								
                                <td>{{$user->coursetitle}}</td>
                                <td>{{$user->coursecode}}</td>
                                <td>{{$user->lecturer}}</td>
								
								@isset($user->timetable->timefrom)
								<td>{{$user->timetable->timefrom}} to {{$user->timetable->timeto}}</td>
								@endisset
								@isset($user->timetable->venue)
								<td> {{$user->timetable->venue}}</td>
								@endisset
								@isset($user->timetable->date)
								<td> {{$user->timetable->date}}</td>
								@endisset
						
							
							</tr>
							
							@endforeach
						</tbody>
					</table>
					
				</div>

				<div class="form-group">
    <a href="{{action('timetableController@pdf',$users->id)}}"> <input type="button" class="btn btn-success" value="Download"></a>
				</div>
				<div class="text-center">
				
				</div>
			
				
		
		</div>
	</div>

@endif

</div>
</div>




@endsection