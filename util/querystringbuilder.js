
function constroiQueryString(json){
    var retorno = '?';
    var naoEhPrimeiroAtributo = false;
    
    //poderia ter feito o primeiro atributo fora do for para nao ter confusao com o &
    //porem se se usasse o mesmo for q se usa aqui (<elemento> in <colecao>) ele iteraria
    //a partir da primeira chave novamente; se se usasse a abordagem numerica, definindo
    //um indice numerico, se perderia a referencia as chaves do json. Isso explica o ternario
    //e a variavel q ele usa
    for(var chave in json){
        if(json.hasOwnProperty(chave)){
            retorno += (naoEhPrimeiroAtributo ? '&' : '') + chave + '=' + json[chave];
            naoEhPrimeiroAtributo = true;
        }
    }
    return retorno;
}
