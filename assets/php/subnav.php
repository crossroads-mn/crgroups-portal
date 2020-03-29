<?php
?>

<md-nav-bar
  md-selected-nav-item="currentNavItem" nav-bar-aria-label="navigation links">
  <md-nav-item md-nav-click="create_new('//selected//')' name="Create New">
    Page One
  </md-nav-item>
  <md-nav-item md-nav-click="goto('page2')" name="Help">
    Page Two
  </md-nav-item>
  <md-nav-item md-nav-click="goto('page3')" name="page3">
    Page Three
  </md-nav-item>
</md-nav-bar>

 <md-sidenav class="md-sidenav-right md-whiteframe-4dp" md-component-id="right">
 <p>text<br><br></p>
</md-sidenav>