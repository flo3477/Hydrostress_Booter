        <div class="mainright">
        	<div class="mainrightinner">
            	
<div class="widgetbox">
<div class="title"><h2 class="chart"><span>Mes Informations</span></h2></div>
<div class="widgetcontent announcement">
<span class="field">
<strong>Mon Nom:</strong> <i><?php echo $_SESSION['username']; ?> </i>
<hr class="dotted">
<strong>Temps D'attaque:</strong> <i><?php echo $status -> maxBoot(); ?> </i>
<hr class="dotted">
<strong>Mes Attaques:</strong> <i><?php echo $status -> userBoots(); ?> </i>
<hr class="dotted">
<strong>Expiration:</strong> <i><?php echo $status -> expire();?> </i>
</span>
</div> 
</div>

<div class="widgetbox">
<div class="title"><h2 class="chart"><span>Statistique Global</span></h2></div>
<div class="widgetcontent announcement">
<span class="field">
<strong>Membres Abonn&eacute;es:</strong> <i><?php echo $status -> registered();?> </i>
<hr class="dotted">
<strong>Total Des Attaques:</strong> <i><?php echo $status -> totalBoots(); ?> </i>
<hr class="dotted">
<strong>Attaque En Cours:</strong> <i><?php echo $status -> running(); ?> </i>
</span>
</div> 
</div>
                

<div class="widgetbox">
<div class="title"><h2 class="chart"><span>Serveurs Informations</span></h2></div>
<div class="widgetcontent announcement">
<strong>Alpha: </strong> <font color="#009900"> En Ligne </font>
<hr class="dotted">
<strong>Echo: </strong> <font color="#009900"> En Ligne </font>
</div>
</div>
                
            </div><!--mainrightinner-->
        </div><!--mainright-->