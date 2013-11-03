// SSC3 entry - submitted by B.Hatt 10/2/04 
// A vaguely Escher like scene (Cubic Space)

// Rather than trying to use loops, a single junction is placed
// in a perfectly reflective box.

#include "colors.inc"
global_settings
{
        max_trace_level 20
}

light_source
{
        <-10, -7, -2 > 1
        shadowless
}

union
{
        box             // containing mirrored box
        {
                -20, 20
                finish
                {
                        reflection 1
                        ambient 1
                }
                hollow
        }
                // junction
        box     {-3, 3}
                // intersecting beams
        box     {<-1, -1, -20 >< 1, 1, 20 >}
        box     {<-1, -20, -1 >< 1, 20, 1 >}
        box     {<-20, -1, -1 >< 20, 1, 1 >}
        rotate 5
        translate 5
        pigment {wrinkles color_map { [0 0.6*White] [1 White] } }
}

