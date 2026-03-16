<header class="header">
		<h2 class="u-name">Task <b>Pro</b>
			<label for="checkbox">
				<i id="navbtn" class="fa fa-bars" aria-hidden="true"></i>
			</label>
		</h2>
		<span class="notification" id="notificationBtn">
			<i class="fa fa-bell" aria-hidden="true"></i>
			<span id="notificationCount">&nbsp;3&nbsp;</span>
		</span>
	</header>
	<div class="notification-bar " id="notificationBar">
		<ul>
			<li>
				<a href="">
					<mark><b> You Have a New Task :</b></mark> ' User Authentication API Endpoint' has been Assigned to You. Please Check your tasks.
					&nbsp;&nbsp;<small> Mar 16,2026 10:30 AM</small>
				</a>
			</li>
		</ul>
	</div>
	<script type="text/javascript">
		var openNotification = false;

		const notification = ()=> {
			let notificationBar = document.querySelector("#notificationBar");
			if(openNotification){
				notificationBar.classList.remove("open-notification");
				openNotification = false;

			}else{
				notificationBar.classList.add("open-notification");
				openNotification = true;
			}
		}
		let notificationBtn = document.querySelector("#notificationBtn");
		notificationBtn.addEventListener("click", notification);

	</script>
	
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	
	<script text type="text/javascript">
		$(document).ready(function(){
			$("#notificationcount").load("app/notification.php");
		});

	</script>