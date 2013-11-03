#include "colors.inc"
#include "skies.inc"

camera {
    location <0,10,-10>
    look_at 0
}

light_source {
    <0, 100, -30> color White
}
light_source {
    <0, 100, 30> color White
}

plane {
    y,-5
    pigment { White }
    finish { reflection 1 }
}

julia_fractal {
    <-0.083,0.0,-0.83,-0.025>
        hypercomplex
        sin
        max_iteration 8
        precision 15
        pigment { Red }
        // scale 5
}
julia_fractal {
    <-0.083,0.0,-0.83,-0.025>
        quaternion
        sqr
        max_iteration 8
        precision 15
        pigment { Blue }
}
