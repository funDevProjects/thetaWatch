<section class="glance py-5" id="thetaField-staking">
	<div class="container css-tw-pagebody">
		<h3 class="text-white">
			Node Staking Reports
		</h3>

		<p class="text-white lead">In addition to analyzing snapshots of Guardian Nodes on the Theta Network, this report also looks at the source wallets where the staked tokens originate.</p>
		<p class="text-white">This report can be used to identify trends and opportunities where wallet sizes change over time.</p>
		<p class="mb-4 text-info"><small><em>Methodology: <span class="text-muted">Explorer API integration pulls node data into local database for analysis.</span></em></small></p>
		
		<div class="row">
			<?php
				echo hud_block('hud-linkbox', [
					'Local Snapshot',
					'Guardian Nodes Report',
					'Updated 2021-12-01',
					'Represents the total circulating supply of Theta.',
					'/charts/guardian-snapshot/20201201',
					'col-md-6'
				]);
			?>
		</div>
	</div>
</section>