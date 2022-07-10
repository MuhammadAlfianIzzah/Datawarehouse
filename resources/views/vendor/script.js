 let export_brand = @json($bybrand);
 let brandname= [];
 export_brand.forEach(function(brand){
 	brandname.push(brand.brand_name);
 });
