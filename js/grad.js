let points = [];
let paraCoord = [];

gradMass.forEach(e => {
    points.push(e.dec)
});

for (let i = 0; i < points.length; i++) {
    
    paraCoord.push({
        left: points[i],
        right: points[i+1]
    })
    i = i + 1
    
}
