<?php 


// Button
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Button", 'donald'),
   "base" => "otbutton",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Donald Element',
   "params" => array( 
      array(
         "type" => "vc_link",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Button", 'donald'),
         "param_name" => "btn",
      ),
      array(
         "type" => "iconpicker",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__('Icon', 'donald'),
         "param_name" => "icon",
         "value" => "",        
      ),
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Button Size", 'donald'),
         "param_name" => "size",
         "value" => array(                        
                     esc_html__('Medium', 'donald')   => '',
                     esc_html__('Larg', 'donald')   => 'ot-lg',
                     esc_html__('Extra Larg', 'donald')   => 'ot-ex',
                  ),
      ),
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Button Color", 'donald'),
         "param_name" => "bg",
         "value" => array(                        
                     esc_html__('Main Color', 'donald')   => 'btn-main-color',
                     esc_html__('Dark Color', 'donald')   => 'btn-sub-color',
                     esc_html__('Border Main Color', 'donald')   => 'btn-border-main-color',
                     esc_html__('Border Dark Color', 'donald')   => 'btn-border-sub-color',
                  ),
      ),
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Button Style", 'donald'),
         "param_name" => "style",
         "value" => array(                        
                     esc_html__('Normal', 'donald')   => '',
                     esc_html__('Rounded', 'donald')   => 'btn-rounded',
                     esc_html__('Pill', 'donald')   => 'btn-pill',
                  ),
      ),
    )));
}

// Member Team
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Member Team", 'donald'),
   "base" => "member",
   "class" => "",
   "category" => 'Donald Element',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "attach_image",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Photo", 'donald'),
         "param_name" => "photo",
         "value" => "",
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Member Name", 'donald'),
         "param_name" => "name",
         "value" => "",
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Member Job", 'donald'),
         "param_name" => "job",
         "value" => "",
      ),
      array(
        'type' => 'vc_link',
         "heading" => esc_html__("Social 1", 'donald'),
         "param_name" => "social1",         
         "description" => esc_html__("Add icon socials follow: http://fontawesome.io/icons/", 'donald'),
      ),
      array(
        'type' => 'vc_link',
         "heading" => esc_html__("Social 2", 'donald'),
         "param_name" => "social2",         
         "description" => esc_html__("Add icon socials follow: http://fontawesome.io/icons/", 'donald'),
      ), 
      array(
        'type' => 'vc_link',
         "heading" => esc_html__("Social 3", 'donald'),
         "param_name" => "social3",         
         "description" => esc_html__("Add icon socials follow: http://fontawesome.io/icons/", 'donald'),
      ), 
      array(
        'type' => 'vc_link',
         "heading" => esc_html__("Social 4", 'donald'),
         "param_name" => "social4",         
         "description" => esc_html__("Add icon socials follow: http://fontawesome.io/icons/", 'donald'),
      ), 
    )
    ));
}


// Year Experience
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Year Experience", 'donald'),
   "base" => "yearexp",
   "class" => "",
   "category" => 'Donald Element',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Big Text", 'donald'),
         "param_name" => "btext",
         "value" => "",
         "description" => esc_html__("Enter number year.", 'donald')
      ),  
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Title", 'donald'),
         "param_name" => "title",
         "value" => "",
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Subtitle", 'donald'),
         "param_name" => "stitle",
         "value" => "",
      ),           
    )
    ));
}

// List Services
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT List Services", 'donald'),
   "base" => "listserv",
   "class" => "",
   "category" => 'Donald Element',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Number Services", 'donald'),
         "param_name" => "num",
         "value" => "",
         "description" => esc_html__("Enter number services. Recommend: 3", 'donald')
      ),  
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Label Button", 'donald'),
         "param_name" => "btn",
         "value" => "",
         "description" => esc_html__("Enter label button read more. Default: Read More", 'donald')
      ),
      array(
         "type" => "checkbox",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Hide Count Number", 'donald'),
         "param_name" => "count",
         "value" => "",
      ),           
    )
    ));
}

// Icon box
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Icon Box", 'donald'),
   "base" => "servicesbox",
   "class" => "",
   "category" => 'Donald Element',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "dropdown",
         "heading" => esc_html__('Style', 'donald'),
         "param_name" => "style",
         "value" => array(                        
                     esc_html__('Style 1 : Icon Top', 'donald')   => 'style1',
                     esc_html__('Style 2 : Icon Left', 'donald')   => 'style2',
                     ), 
      ),
      array(
        'type' => 'attach_image',
         "heading" => esc_html__("Icon Image", 'donald'),
         "param_name" => "image",         
         "description" => esc_html__("Upload Image.", 'donald'),
      ),
      array(
         "type" => "iconpicker",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Icon", 'donald'),
         "param_name" => "icon",
         "value" => "",
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Title", 'donald'),
         "param_name" => "title",
         "value" => "",
         "description" => esc_html__("Title of box", 'donald')
      ),
      array(
         "type" => "textarea_html",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Description", 'donald'),
         "param_name" => "content",
         "value" => "",
         "description" => esc_html__("content right.", 'donald')
      ),       
    )
    ));
}


// Testimonial Slider
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Testimonial Silder", 'donald'),
   "base" => "testslide",
   "class" => "",
   "category" => 'Donald Element',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__('Slide Speed', 'donald'),
         "param_name" => "speed",
         "description" => esc_html__("Enter number millisecond. Default: 6000.", 'donald')
      ), 
      array(
         "type" => "dropdown",
         "heading" => esc_html__('Style', 'donald'),
         "param_name" => "style",
         "value" => array(                        
                     esc_html__('Style 1: Without Avatar', 'donald')   => 'style1',
                     esc_html__('Style 2: With Avatar', 'donald')   => 'style2',
                     ), 
      ),
    )));
}


// Call To Action
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Call To Action", 'donald'),
   "base" => "call_to",
   "class" => "",
   "category" => 'Donald Element',
   "icon" => "icon-st",
   "params" => array(  
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Title", 'donald'),
         "param_name" => "title",
         "value" => "",
      ),
      array(
        'type' => 'vc_link',
         "heading" => esc_html__("Button", 'donald'),
         "param_name" => "linkbox",         
         "description" => esc_html__("Add link to Button.", 'donald'),
      ),
      array(
         "type" => "checkbox",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Background Light", 'donald'),
         "param_name" => "light",
         "value" => "",
      ),     
    )
   ));
}



// Lastest Blog
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Latest Blog", 'donald'),
   "base" => "lastest_blog",
   "class" => "",
   "category" => 'Donald Element',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Number Visible", 'donald'),
         "param_name" => "number",
         "value" => array(                        
                     esc_html__('2 Items', 'donald')   => '2',
                     esc_html__('3 Items', 'donald')   => '3',
                     esc_html__('4 Items', 'donald')   => '4',
                     ),
      ),
      array(
         "type" => "checkbox",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Hide Date", 'donald'),
         "param_name" => "date",
         "value" => "",
      ),
      array(
         "type" => "checkbox",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Hide Excerpt", 'donald'),
         "param_name" => "exc",
         "value" => "",
      ),
   )));
}

// Portfolio Filter
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Portfolio Filter", 'donald'),
   "base" => "portfoliof",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Donald Element',
   "params" => array( 
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Number Show", 'donald'),
         "param_name" => "num",
         "description" => esc_html__("Number Show of box", 'donald')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Text Show All", 'donald'),
         "param_name" => "all",
      ),
      array(
         "type" => "dropdown",
         "heading" => esc_html__('Column', 'donald'),
         "param_name" => "col",
         "value" => array(
                     esc_html__('3 Columns', 'donald')     => '4', 
                     esc_html__('4 Columns', 'donald')     => '3',
                     esc_html__('2 Columns', 'donald')     => '6',
                  ), 
      ),
      array(
         "type" => "checkbox",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Popup Video", 'donald'),
         "param_name" => "popup",
      ),
      array(
         "type" => "checkbox",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("No Gutter", 'donald'),
         "param_name" => "gutter",
      ),
      array(
         "type" => "checkbox",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Hide Filter", 'donald'),
         "param_name" => "filter",
      ),
      array(
         "type" => "checkbox",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Hide Categories Under Title", 'donald'),
         "param_name" => "categ",
      ),
    )));
}

// Portfolio Slider
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Portfolio Silder", 'donald'),
   "base" => "portfolio_sli",
   "class" => "",
   "category" => 'Donald Element',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Number Portfolio Show", 'donald'),
         "param_name" => "number",
         "value" => "",
         "description" => esc_html__("Non-existing number for show all post.", 'donald')
      ), 
      array(
        'type' => 'textfield',
         "heading" => esc_html__("Label Button Details", 'donald'),
         "param_name" => "btn",
      ),
      array(
        'type' => 'textfield',
         "heading" => esc_html__("Speed Slider", 'donald'),
         "param_name" => "speed",
      ),
      array(
        'type' => 'textfield',
         "heading" => esc_html__("Label Button View All", 'donald'),
         "param_name" => "all",
      ),
      array(
        'type' => 'textfield',
         "heading" => esc_html__("Link Button View All", 'donald'),
         "param_name" => "link",
      ),
      array(
        'type' => 'textfield',
         "heading" => esc_html__("Top Position Button (px)", 'donald'),
         "param_name" => "top",
         "description" => esc_html__("Default: -110px.", 'donald')
      ),
    )
    ));
}


// Our Facts
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Fun Facts", 'donald'),
   "base" => "facts",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Donald Element',
   "params" => array( 
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Title", 'donald'),
         "param_name" => "title",
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Number", 'donald'),
         "param_name" => "num",
         "description" => esc_html__("Number of box", 'donald')
      ),
     
    )));
}


// Logo Client
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Logo Clients", 'donald'),
   "base" => "clients",
   "class" => "",
   "category" => 'Donald Element',
   "icon" => "icon-st",
   "params" => array(
      array(
         "type" => "attach_images",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__('Logo Clients', 'donald'),
         "param_name" => "gallery",
         "value" => "",
         "description" => esc_html__("Use link out for logo client by enter link input caption image, View guide here: http://vegatheme.com/images/add-link-logo.jpg , Recomended Size: 200 x 130. ", 'donald')
      ),
       array(
         "type" => "textfield",
         "heading" => esc_html__('Speed Slider', 'donald'),
         "param_name" => "speed",
         "value" => '',
      ),  
      array(
         "type" => "textfield",
         "heading" => esc_html__('Visible Number', 'donald'),
         "param_name" => "num",
         "value" => '',
         "description" => esc_html__('Number columns each rows. Recommend: 4, 5 or 6. Default: 6.', 'donald')
      ),     
    )
    ));
}

// Contact Info
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Contact Info", 'donald'),
   "base" => "ctinfo",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Donald Element',
   "params" => array(
      array(
         "type" => "attach_image",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Icon Image", 'donald'),
         "param_name" => "image",
      ),
      array(
         "type" => "iconpicker",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Icon", 'donald'),
         "param_name" => "icon",
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Title", 'donald'),
         "param_name" => "title",
      ),
      array(
         "type" => "textarea_html",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Details", 'donald'),
         "param_name" => "content",
      ),
    )));
}


//Google Map

if(function_exists('vc_map')){
   vc_map( array(
   "name"      => __("OT Google Maps", 'calliope'),
   "base"      => "maps",
   "class"     => "",
   "icon" => "icon-st",
   "category"  => 'Content',
   "params"    => array(
      
      array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Latitude", 'calliope'),
         "param_name"=> "latitude",
         "value"     => 40.706187,
         "description" => __("", 'calliope')
      ),
     array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Longitude", 'calliope'),
         "param_name"=> "longitude",
         "value"     => -74.008833,
         "description" => __("", 'calliope')
      ),     
     array(
         "type"      => "attach_image",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Location Image", 'calliope'),
         "param_name"=> "imgmap",
         "value"     => "",
         "description" => __("Upload Location Image.", 'calliope')
      ),
      array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Tootip Location Click", 'calliope'),
         "param_name"=> "tooltip",
         "value"     => '',
         "description" => __("", 'calliope')
      ),
     array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Zoom map number", 'calliope'),
         "param_name"=> "zoom",
         "value"     => 15,
         "description" => __("", 'calliope')
      ),
     array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Height (px)", 'calliope'),
         "param_name"=> "height",
         "value"     => '',
         "description" => __("Ex: 400px.", 'calliope')
      ),
    )));
}