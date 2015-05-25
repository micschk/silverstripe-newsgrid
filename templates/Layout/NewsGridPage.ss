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

		<div class="main typography newsgridpage" role="main" id="main">
			
			<h2><small><a href="$ArchiveLink">$Date</a></small></h2>
			<h1 class="page-header">$Title</h1>
			$Content

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
