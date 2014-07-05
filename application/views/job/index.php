<html>
<head>
	<title>Example Job</title>
	<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery/jquery-1.6.2.min.js"></script>
</head>
<body>
<div class="job-cnt">
	<ul class="job-list">
		<li class="job-item"><a href="javacript:;" job="job_1">job_1</a></li>
		<li class="job-item"><a href="javacript:;"  job="job_2">job_2</a></li>
	</ul>
	<div class="job-log">

	</div>
</div>
</body>
</html>
<script type="text/javascript">
window.base_url = '<?php echo base_url()?>';
// GET QUEUE FORM THE SERVER
Queue = <?php echo json_encode ($job_queues) ?>;
Queue = {
	job : {},
	watch : {},

}
Worker = {
	deleteJob:function(jobName){
		$.post(base_url+'job/delete_job/'+jobName,function(status){
			console.log(status);
			
		},'json');
	},
	doJob : function(jobName){
		// CEK JOB IN QUEUE
		// if( typeof Queue.job[jobName]  != 'undefined')
		// {
		// 	console.log('Job Is In progress');
		// 	Worker.watchJob(jobName,3000);
		// 	return;
		// }
		// else
		// {
		// 	Queue.job[jobName] = this;
		// }	

		$.post(base_url+'job/do_job/'+jobName,function(worker){
			console.log(worker);
			if(worker.status == 'JOB_EXECUTED')
			{
				Worker.watchJob(jobName,3000);
			}
		},'json');
	},
	watchJob : function(jobName,interval){
		// CEK WATCHDOG IN QUEUE
		// if( typeof Queue.watch[jobName]  != 'undefined')
		// {
		// 	console.log('Watch Job Is In progress');
		// 	Worker.watchJob(jobName,3000);
		// 	return;
		// }
		// else
		// {
		// 	Queue.watch[jobName] = this;
		// }
		if( typeof Worker.watchJob[jobName] == 'undefined' )
			Worker.watchJob[jobName] = {progress:0,isCompleted:function(){return Worker.watchJob[jobName].progress==100}}

		// REAL JOB
		$.post(base_url+'job/display_progress/'+jobName,function(progress){
			//console.log(worker);
			progress = parseInt(progress);
			progress = progress > 1 ? progress : 0;
			Worker.watchJob[jobName].progress =  progress; 
			Worker.displayWatchDog(jobName,progress);
			console.log(progress);
		});

		// DO IT AGAIN UNTIL PROGRESS COMPLETED
		if( !Worker.watchJob[jobName].isCompleted() )
		{
			setTimeout(function(){
				Worker.watchJob(jobName,interval);
			},interval);
		}
		else
		{
			Worker.jobComplete(jobName);
		}
	},
	jobComplete : function(jobName)
	{
		$.post(base_url+'job/job_complete/'+jobName,function(action){
			console.log(action);
		},'json');
	},
	displayWatchDog: function(jobName,progress){
		var jobClass = 'watch-'+jobName
		if( !$('.job-log .' + jobClass).length )
			$('.job-log').append($('<div></div>').addClass(jobClass).css('color','#'+Math.floor(Math.random()*16777215).toString(16)));
		$('.job-log .' + jobClass).html('<span>'+jobName+' ['+progress+'</span> %]');
	}
}
$(document).ready(function(){
	$('.job-item > a').click(function(){
		var jobName = $(this).attr('job');
		Worker.doJob(jobName);
		return false;
	});
});
</script>