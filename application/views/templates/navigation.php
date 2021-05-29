<?php
	function active_if($boolean) {
		return $boolean ? 'active' : '';
	}

	function style_active_if($boolean) {
		return $boolean ? 'display: block;' : 'display: none;';
	}
?>
<aside id="sidebar"  style="background-color: #2B333E;">


	<div id="sidebar-wrap"  style="background-color: #2B333E;">

		<div class="panel-group slim-scroll" role="tablist"  style="background-color: #2B333E;">
			<div class="panel panel-default">
				<div class="panel-heading" role="tab">
					<h4 class="panel-title">
						<a data-toggle="collapse" href="#sidebarNav">
							Navigation <i class="fa fa-angle-up"></i>
						</a>
					</h4>
				</div>
				<div id="sidebarNav" class="panel-collapse collapse in" role="tabpanel">
					<div class="panel-body">
						<ul id="navigation"  style="background-color: #2B333E;">
						<?php foreach ($this->default->menu() as $q):?>
							<li class="<?= active_if(in_array($q['menu_name'], $navigation)) ?>">
								<?php $menu_url = $q['menu_url'] == '#' ? '#' : (site_url() . $q['menu_url']); ?>
								<a href="<?= $menu_url ?>" title="<?=$q['menu_name']?>"><i class="<?=$q['menu_icon']?>"></i> <span><?=$q['menu_name']?></span></a>
								<?php $sub_menu =  $this->default->sub_menu($q['menu_id']);
									if($sub_menu):
								?>
								<ul style="<?= style_active_if(in_array($q['menu_name'], $navigation)) ?>; display: block;">
										<?php foreach ($sub_menu as $row):?>
										<li>
											<a href="<?= site_url() ?><?=$row['menu_url']?>"><i class="fa fa-caret-right"></i> <?=$row['menu_name']?></a>
										</li>
										<?php endforeach;?>
									</ul>
									<?php 
										endif;
									?>
								</li>
								<?php endforeach;?>
							</li>
						</ul>
						<!--/ NAVIGATION Content -->

					</div>
				</div>
			</div>
		</div>

	</div>


</aside>