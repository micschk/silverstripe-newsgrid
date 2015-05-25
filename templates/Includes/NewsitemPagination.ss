<<<<<<< HEAD
<% if $PaginatedItems.MoreThanOnePage %>
	<div id="pageNumbers">
		<p>
			<% if $PaginatedItems.NotFirstPage %>
				<a class="pages prev" href="$PaginatedItems.PrevLink" title="View the previous page">&lt;</a>
			<% end_if %>

	    	<% loop $PaginatedItems.PaginationSummary(4) %>
=======
<% if Items.MoreThanOnePage %>
	<div id="pageNumbers">
		<p>
			<% if Items.NotFirstPage %>
				<a class="pages prev" href="$Items.PrevLink" title="View the previous page">Prev</a>
			<% end_if %>

	    	<% loop Items.PaginationSummary(4) %>
>>>>>>> 130fca7b4e80dd132a9e8b4b12e1ed5a3e4cd839
				<% if CurrentBool %>
					<span class="current">$PageNum</span>
				<% else %>
					<% if Link %>
						<a href="$Link" title="View page number $PageNum">$PageNum</a>
					<% else %>
						&hellip;
					<% end_if %>
				<% end_if %>
			<% end_loop %>

<<<<<<< HEAD
			<% if $PaginatedItems.NotLastPage %>
				<a class="pages next" href="$PaginatedItems.NextLink" title="View the next page">&gt;</a>
=======
			<% if Items.NotLastPage %>
				<a class="pages next" href="$Items.NextLink" title="View the next page">Next</a>
>>>>>>> 130fca7b4e80dd132a9e8b4b12e1ed5a3e4cd839
			<% end_if %>
		</p>
	</div>
<% end_if %>
