<!----------------------------------------------------------
  File: index.ctp
  Description: Dashboard Index

  Author: jgoll
  Date:   Mar 22, 2010
<!---------------------------------------------------------->

<?php echo $html->css('user-dashboard.css'); ?>
<?php echo $html->css('jquery-ui-1.7.2.custom.css');?>

<div class="user-dash-board">
	<h2><?php __('Dash Board - Welcome '); echo Authsome::get('username'); ?></h2>
	
	<div class="user-dash-board-manage-panel" >
		<fieldset >
			<legend >Manage Account</legend>
			<p>
				<ul>
				    <?php
				    $currentUser	=  Authsome::get();
					$currentUserId	= $currentUser['User']['id'];	
				    ?>
				    <?if (Authsome::check('users/index')):?>
				    <li>
				        <?php echo($html->link('Manage Users','/users/index'))?>
				    </li>
				    <?endif;?>
				    <?if (Authsome::check(' user_group_permissions/index')):?>
				    <li>
				        <?php echo($html->link('Manage Permissions','/user_group_permissions/index'))?>
				    </li>
				    <?endif;?>
				    <li><?php echo($html->link('Change Account Information',"/users/edit/$currentUserId"))?></li>
				    <li><?php echo($html->link('Change Password','/users/change_password'))?></li>
				    <li><?php echo($html->link('Logout','/users/logout'))?></li>
				</ul>
			</p>
		</fieldset>
	</div>
	
	<?php if(count($projects)> 0):?>
	<div class="user-dash-board-project-panel">
		<fieldset>
		<legend >Manage Projects</legend>
		
		<div id="accordion">
			<?php foreach($projects as $project) {	
					
						echo("<h3><a href=\"#\">{$project['Project']['name']}</a></h3><div><p>	
						<strong>{$project['Project']['description']}</strong>			
							<ul><li>Last Updated {$project['Project']['updated']}</li>
								
													<li>Populations ".count($project['Population'])."</li>
							<li>Libraries ".count($project['Library'])."</li>				
							<ul></p><BR>
							<p>
								<ul>	
									<li>".$html->link('Edit Project Information',"/projects/edit/{$project['Project']['id']}")."</li>
									<li>".$html->link('Manage Project Permissions',"/users/editProjectUsers/{$project['Project']['id']}" )."</li>				    		
						    	</li>
							</ul></p>
							</div>");
				}
			?>
		</div>
	</div>
	<?php endif;?>
	<div class="user-dash-board-feedback-panel"> 
		<fieldset>
		<legend >Feedback</legend>
		<?php 
			echo($form->create('Users', array('action' => 'feedback')));
			echo $form->input( 'type', array( 'options' => array('feature request'=>'feature request','bug report'=>'bug report','data load'=>'data load','other'=>'other'), 'selected' => 'other','label' => false, 'empty'=>'--select feedback type--'));
			echo $form->input('feedback',array('type' => 'textaerea'));
			echo $form->submit('submit');
			echo($form->end()); 
		?>		
	</fieldset>
	</div>
<?php if (!empty($news)):?>	
	<div class="user-dash-board-news-panel" > 
		<fieldset >
			<legend >News</legend>
			<?php foreach( $news as $newsItem ) : ?>
			        <?php echo $html->link($newsItem['GosBlog']['title'], $newsItem['GosBlog']['link']); ?><br/>
			        <em><?php echo $newsItem['GosBlog']['pubDate']; ?></em>
			        <hr>
			<?php endforeach; ?>
	
		</fieldset>
	</div>
</div>
<?php endif;?>

<script type="text/javascript">
	jQuery(function() {
		jQuery("#accordion").accordion({fillSpace: true, event: "mouseover"
			
			});
		});
</script>