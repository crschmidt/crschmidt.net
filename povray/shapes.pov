#include "colors.inc"
#include "skies.inc"
plane {
    y,-5
    //normal { onion 2 scale 5}
    pigment { Blue } //warp { turbulence 1.5 } } 
    finish { reflection  1  }
    }
     julia_fractal {
       <-0.083,0.0,-0.83,-0.025>
         quaternion
           sqr
             max_iteration 8
               precision 15
                pigment { Red } 
                translate -3*y+3*z
                }
 /*lathe {
  linear_spline
  5,
  <2, 0>, <3, 0>, <3, 5>, <2, 5>, <2, 0>
  pigment {Red}
    scale .1
    translate -2*z+-5*x
 }*/
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

