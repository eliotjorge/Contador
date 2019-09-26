 var elemento = document.getElementById("numero");
	
	let request = new XMLHttpRequest();
	request.open('GET', 'https://www.sumr.com/contadorDioxi/dato.json', true);
  	request.onload = function () {
      	let dato = JSON.parse(this.response);
		var numero = dato["dato"]["co2"];
		elemento.innerHTML = formatNumber.new(numero);
		setInterval(function(){
			numero += 0.027;
			elemento.innerHTML = formatNumber.new(numero.toFixed(2));
		},1000);
    
    }
    request.send();


var formatNumber = {
  separador: ".", // separador para los miles
  sepDecimal: ",", // separador para los decimales
  formatear: function(num) {
    num += "";
    var splitStr = num.split(".");
    var splitLeft = splitStr[0];
    var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : "";
    var regx = /(\d+)(\d{3})/;
    while (regx.test(splitLeft)) {
      splitLeft = splitLeft.replace(regx, "$1" + this.separador + "$2");
    }
    //return this.simbol + splitLeft +splitRight;
    return splitLeft + splitRight + this.simbol;
  },
  new: function(num, simbol) {
    this.simbol = simbol || "";
    return this.formatear(num);
  }
};
