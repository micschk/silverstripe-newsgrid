<div class="row">

	<div class="col-sm-12">

		$Content
		$Form
		
		<% include FilterableArchiveFilter %>
		
		<ul class="itemList">
		<% loop $PaginatedItems %>
			<li>
				<div class="itemsum">
					$FeaturedImage.SetWidth(240)
					<h2><a href="$Link"><small>$Date.Format(d-m-Y)</small><br />$Title</a></h2>
					<p>$Content.FirstParagraph</p>
					<a href="$Link">Lees meer</a>
				</div>
			</li>
		<% end_loop %>
		</ul>

		<% include FilterableArchivePagination %>
		
	</div>
</div>