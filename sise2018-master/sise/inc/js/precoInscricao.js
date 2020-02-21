//Contém uma lista com todos os checkbox de minicurso
var listaDeCheckBox = document.getElementsByClassName("checkJS");

//Contém uma lista com todos os options
var listaDeOptions = document.getElementsByName("opcoes");
var comboParcelas = document.getElementById("comboParcelas");

//Busca o elemento valor final
var tagValorFinal = document.getElementById("valorFinal");
var valorFinal = tagValorFinal.value;

//Buscar a div de pagamentos
var divPagamento = document.getElementById("pagamento");
//Buscar o botao de pagamento
var radioPagamento = document.getElementById("radioPagamento");

function atualizarValor(curso,valor) {
	//Calculando valor
	for (i=0; i < listaDeCheckBox.length; i++) {
		if (listaDeCheckBox[i].value == curso) {
			if (listaDeCheckBox[i].checked) {
				valorFinal = (parseInt(valorFinal) + parseInt(valor));
				// colocar requiredtrue
				//MOSTRA A DIV DE PAGAMENTO PARA CASO O VALOR ESCOLHIDO SEJA MAIOR QUE 0
				if (valorFinal > 0) {
					divPagamento.style.display = "block";
                    radioPagamento.required = true;
				}
			} else if (!listaDeCheckBox[i].checked) {
                valorFinal = (parseInt(valorFinal) - parseInt(valor));
                //ESCONDE A DIV DE PAGAMENTO PARA CASO O VALOR ESCOLHIDO SEJA IGUAL A 0
                // colocar required false
                if (valorFinal == 0) {
					//dar um hidden na div pagamentos e tirar o required
					divPagamento.style.display = "none";
                    radioPagamento.required = false;
				}
			}
        }
	}

	//Limpa o ComboBox
	while (comboParcelas.length) {
		comboParcelas.remove(0);
	}

	qntParcelas = parseInt(document.getElementById("qntdParcelasPermitidas").value);

	for (i = 1; i <= qntParcelas; i++) {
		var op = document.createElement("option");
		op.value = i;
		op.text = ""+i+" x R$ " + parseFloat((parseInt(valorFinal) / i).toFixed(2));
		comboParcelas.add(op,comboParcelas.options[(i-1)]);
	}
}