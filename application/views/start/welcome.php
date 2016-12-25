
<style type="text/css">

::selection { background-color: #E13300; color: white; }
::-moz-selection { background-color: #E13300; color: white; }

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

h1 {
	color: #44A;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}

code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#body { margin: 0 15px 0 15px; color:#555; }

p.footer {
	text-align: right;
	font-size: 11px;
	border-top: 1px solid #D0D0D0;
	line-height: 32px;
	padding: 0 10px 0 10px;
	margin: 20px 0 0 0;
}

#container {
	margin: 10px;
	background:rgba(210,210,210,0.75);
	border: 1px solid #D0D0D0; border-radius:10px;
	box-shadow: 0 0 8px #D0D0D0;
}

code {
	border-radius:8px;
}

.pipGroup {
	padding:2px;
	display: flex;
	flex-direction: row;
	justify-content: center;
	align-items: center;
	border:1px solid rgb(230, 200, 40);
	border-radius: 20px;
	background:rgba(150, 150, 150, 0.5);
}
.pipGold {
	width:25px; height:25px;
	margin:2px;
	border:2px solid rgb(230, 200, 40);
	border-radius: 50%;
	background: gold; /* For browsers that do not support gradients */
  	background: -webkit-linear-gradient(left top, #cdb117, #FFFFEF, #dbbe22); /* For Safari 5.1 to 6.0 */
  	background: -o-linear-gradient(bottom right, #cdb117, #FFFFEF, #dbbe22); /* For Opera 11.1 to 12.0 */
  	background: -moz-linear-gradient(bottom right, #cdb117, #FFFFEF, #dbbe22); /* For Firefox 3.6 to 15 */
  	background: linear-gradient(to bottom right, #cdb117, #FFFFEF, #dbbe22); /* Standard syntax */
}
.pipBlack {
	width:25px; height:25px;
	margin:2px;
	border:2px solid rgb(230, 200, 40);
	border-radius: 50%;
	background: black; /* For browsers that do not support gradients */
  	background: -webkit-linear-gradient(left top, black, #888, black); /* For Safari 5.1 to 6.0 */
  	background: -o-linear-gradient(bottom right, black, #888, black); /* For Opera 11.1 to 12.0 */
  	background: -moz-linear-gradient(bottom right, black, #888, black); /* For Firefox 3.6 to 15 */
  	background: linear-gradient(to bottom right, black, #888, black); /* Standard syntax */
}

</style>
<?php
/*
		<div class="pipGroup" style="position:absolute; top:15px; right:15px;">
			<div class="pipBlack"></div> <div class="pipGold"></div> <div class="pipGold"></div>
		</div>
*/
?>
<div id="container">
	<h1>Welcome to STARBASE CBC!</h1>

	<div id="body">
		<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

		<p>About this WebSite:</p>
		<code>At this site you can safely store code sniplets or any other text you'd like to keep securely,
			We encrypt all data, and because of the encryption type, we can not rescue it if you lose your password.
			We are currently developing this site to add requested features so stay tuned for more to come.
		</code>

		<p>The United Federation of Earth:</p>
		<code>A collective of people determined to "make a difference",
			to help save our beautiful Planet for generations to come.</code>

		<p>If you have an account to this WebSite, you are in the few trusted individuals allowed to see our interworkings.
			Please respect people's privacy and honor the Starfleet principles.
		</p>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds.
		<?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>'.CI_VERSION.'</strong>' : '' ?>
	</p>
</div>
