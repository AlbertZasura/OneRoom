@extends('Layout.SidePanel')

@section('title', 'Jadwal | OneRoom')

@section('content')
    <h1>Jadwal</h1><br>
    <div class="d-flex">
        <div class="w-200px">
            <h5>Jadwal Selanjutnya</h5>
            @foreach ($current as $s )
                <div class="card-box bg-hijau-tua mb-2">
                    <div class="card-body">
                        <div>{{$s->course->name}} <strong>{{$s->class->name}}</strong></div>
                        <div class="text-right"><small>{{ $s->start_time }} - {{ $s->end_time }}</small></div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="ml-20 w-85">
           <div class="card bg-white m-lg-5 border-radius-8px">
               <div class="card-body">
                @foreach ($schedules_group as $sch)
                    @include('schedules._show')
                @endforeach
                <div class="col-md-12">
                    <div id='wrap' class="container">
                        <div id='calendar'></div>
                        <div style='clear:both'></div>
                    </div>
                </div>
               </div>
           </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
    
            /*  className colors
    
            className: default(transparent), important(red), chill(pink), success(green), info(blue)
    
            */
    
    
            /* initialize the external events
            -----------------------------------------------------------------*/
    
            $('#external-events div.external-event').each(function() {
    
                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };
    
                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);
    
                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 999,
                    revert: true,      // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });
    
            });
    
    
            /* initialize the calendar
            -----------------------------------------------------------------*/
    
            var calendar =  $('#calendar').fullCalendar({
                header: {
                    left: 'title',
                    right: 'prev,next today'
                },
                editable: false,
                firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
                selectable: true,
                defaultView: 'month',
    
                axisFormat: 'h:mm',
                columnFormat: {
                    month: 'ddd',    // Mon
                    week: 'ddd d', // Mon 7
                    day: 'dddd M/d',  // Monday 9/7
                    agendaDay: 'dddd d'
                },
                titleFormat: {
                    month: 'MMMM yyyy', // September 2009
                    week: "MMMM yyyy", // September 2009
                    day: 'MMMM yyyy'                  // Tuesday, Sep 8, 2009
                },
                allDaySlot: false,
                selectHelper: true,
                select: function(start, end, allDay) {
                    let d = start.getDate() < 10 ? '0'+start.getDate() : start.getDate();
                    let m = ((start.getMonth()+1) < 10) ? '0'+(start.getMonth()+1) : (start.getMonth()+1);
                    let doc = document.getElementById('showSchedules'+start.getFullYear()+'-'+m+'-'+d);
                    if(doc){
                        var myModal = new bootstrap.Modal(doc, {
                            keyboard: false
                        })
                        myModal.toggle();
                    }
				calendar.fullCalendar('unselect');
			},
                droppable: false, // this allows things to be dropped onto the calendar !!!
                drop: function(date, allDay) { // this function is called when something is dropped
    
                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject');
    
                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject);
    
                    // assign it the date that was reported
                    copiedEventObject.start = date;
                    copiedEventObject.allDay = allDay;
    
                    // render the event on the calendar
                    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
    
                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove();
                    }
    
                },
    
                events: [
                    @foreach ($schedules as $s)
                        @php
                            $start= Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $s->date.$s->start_time);
                            $end= Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $s->date.$s->end_time);
                        @endphp 
                        {
                            title: "{{ $s->course->name }}",
                            start: "{{ $start }}",
                            end: "{{ $end }}",
                            className: 'info',
                            allDay: false
                        },
                    @endforeach
                ],
            });
    
        });
    </script>
@endsection
