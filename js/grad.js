// let points = [];
// let paraCoord = [];

// gradMass.forEach(e => {
//     points.push(e.dec)
// });

// for (let i = 0; i < points.length; i++) {
    
//     paraCoord.push({
//         left: points[i],
//         right: points[i+1]
//     })
//     i = i + 1
    
// }
function dmsToDecimal(dms) {
  // Заменяем кириллическую "Е" на латинскую "E" для корректного парсинга
  dms = dms.replace(/Е/g, 'E');
  
  const parts = dms.match(/(\d+)°(\d+)'([\d.]+)"([NSEW])/);
  if (!parts) return null;
  
  const degrees = parseFloat(parts[1]);
  const minutes = parseFloat(parts[2]);
  const seconds = parseFloat(parts[3]);
  const direction = parts[4];
  
  let decimal = degrees + minutes / 60 + seconds / 3600;
  if (direction === 'S' || direction === 'W') {
    decimal = -decimal;
  }
  return decimal;
}
function parseCoordinates(input) {
  const lines = input.trim().split('\n');
  return lines.map(line => {
    const [namePart, coordsPart] = line.split(':');
    const name = namePart.trim();
    const [latPart, lonPart] = coordsPart.trim().split(',');
    
    return {
      name,
      latitude: latPart.trim(),
      longitude: lonPart.trim()
    };
  });
}

const coordinates = parseCoordinates(geoMass);
console.log(coordinates);


const decimalCoordinates = coordinates.map(point => ({
  name: point.name,
  latitude: dmsToDecimal(point.latitude),
  longitude: dmsToDecimal(point.longitude)
}));

console.log(decimalCoordinates);