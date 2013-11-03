#include "colors.inc"
#include "skies.inc"
plane {
    y,-5
    normal { bumps 5 scale 2  }
    pigment { Blue } 
    finish { reflection  1  }
    }
  sphere {
    <-16,4,20>,2
    pigment { White }
    finish { phong 2 } 
  }
  sphere {
    <16,4,20>,2
    pigment { White }
    finish { phong 2 } 
  }
  sphere {
    <0,2,0>,2
    pigment { White }
    finish { phong 2 } 
  }
  
sky_sphere { S_Cloud5 }
   light_source{ <5,5,-5> White }
   light_source{ <5,5,5> White }
  camera{
      location <0, 2, -10>
          look_at 0
                }

