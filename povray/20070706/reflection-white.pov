#include "colors.inc"
#include "textures.inc"

camera {
  location <7.5, 20, -20>
  look_at <0, 5, 0>
}

plane { // the floor
  y, 0  // along the x-z plane (y is the normal vector)
  pigment { checker color Black color White  } // checkered pattern
}

sphere {
  <0, 10, 0>, 4
  pigment {    color White  }
  }
  
 

light_source { <0, 20, 10> color White }

light_source { <10, 20, -10> color White }

light_source { <-10, 20, -10> color White }