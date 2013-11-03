#include "colors.inc"
#include "stones.inc"
global_settings {
    max_trace_level 50
}

camera {
    location <0, 10, 0>
    look_at <-10,0,-10>
}

light_source {
    <1,8,0> color White
}
light_source {
    <1,-100,0> color White
}
light_source {
    <1,2,0> color White
}

//light_source {
//    <-10,5,5> color  White
//}

/*sphere {
    <0,5,5>,2
    // pigment  {  }
    texture { T_Stone4 }
    finish { reflection 1 } 
}*/
union {
    torus {
        3,1
    texture { T_Stone2 }
    }


    sphere {
        <0,0,0>,1
        // texture { T_Stone5 }
        //finish { phong 1 }
    }
    sphere {
        <0,4,0>, 1
    }
        //finish { reflection .5 } 
        pigment { color White}
}


//light_source {
//    <-10,5,5> color  White
//}

/*sphere {
    <0,5,5>,2
    // pigment  {  }
    texture { T_Stone4 }
    finish { reflection 1 } 
}*/
union {
    torus {
        3,1
    texture { T_Stone2 }
    }


    sphere {
        <0,0,0>,1
        // texture { T_Stone5 }
        //finish { phong 1 }
    }
    sphere {
        <0,4,0>, 2
    }
        //finish { reflection .5 } 
        pigment { color White}
}

union {
    plane {
        x-.03*y,4
    }
    plane {
        x+.03*y,-4
    }
    plane {
        z-.03*y,4
    }
    plane {
        z+.03*y,-4
    }
    finish { reflection 1  }
}
