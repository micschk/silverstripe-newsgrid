<div class="row">

	<% if $findpage(HomePage).LeftCol=="subnav" %>
	<div class="three columns"><% include SecondaryMenu %></div>
	<% else_if $findpage(HomePage).LeftCol=="empty" %><div class="three columns"></div>
	<% else_if $findpage(HomePage).LeftCol=="owncontent" %>
	<div class="three columns">
		$LeftColContent
	</div>
	<% end_if %>

	<div class="<% with $findpage(HomePage) %><% if $LeftCol=="fill" && $RightCol=="fill" %>twelve
		 <% else_if $LeftCol=="fill" || $RightCol=="fill" %>nine
		 <% else %>six<% end_if %><% end_with %> columns">
		 
		$BreadCrumbs

		<div class="main typography" role="main" id="main">
			
			<h1 class="page-header">$Title</h1>
			$Content
			
			<form class="archivefilter">
				<div>
				$ArchiveUnitDropdown <!-- from filterablearchive -->
				</div>
			</form>

				<div class="itemList">
				<% if $PaginatedItems %>
				<% loop PaginatedItems %>

					<article class="item">
						<h2>
							<% if $Date %><small>$Date</small><br /><% end_if %>
							<a href="$Link">$Title</a>
						</h2>
						<p>$Content.FirstParagraph</p>
						<p><a href="$Link">Lees verder</a></p>
					</article>

				<% end_loop %>
				<% else %>
				None found
				<% end_if %>
				</div>

				<% include NewsItemPagination %>

		</div>


		
		<footer class="content-footer">
			<% include PrintShare %>
			<%-- include LastEdited --%>
		</footer>
		
		
	</div>

	<% if $findpage(HomePage).RightCol=="subnav" %>
	<div class="three columns"><% include SecondaryMenu %></div>
	<% else_if $findpage(HomePage).RightCol=="empty" %><div class="three columns"></div>
	<% else_if $findpage(HomePage).RightCol=="owncontent" %>
	<div class="three columns">
		$RightColContent
	</div>
	<% end_if %>

</div>
