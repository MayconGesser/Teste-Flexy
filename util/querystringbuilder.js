
function constroiQueryString(json){
    var retorno = '?';
    var naoEhPrimeiroAtributo = false;
    
    //poderia ter feito o primeiro atributo fora do for para nao ter confusao com o &
    //porem se se usasse o mesmo for q se usa aqui (<elemento> in <colecao>) ele iteraria
    //a partir da primeira chave novamente; se se usasse a abordagem numerica, definindo
    //um indice numerico, se perderia a referencia as chaves do json. Isso explica o ternario
    //e a variavel q ele usa
    
    //metodo de iteração e checagem de chaves copiado desse link:
    //http://stackoverflow.com/questions/684672/how-do-i-loop-through-or-enumerate-a-javascript-object
    for(var chave in json){
        if(json.hasOwnProperty(chave)){
            retorno += (naoEhPrimeiroAtributo ? '&' : '') + chave + '=' + json[chave];
            naoEhPrimeiroAtributo = true;
        }
    }
    return retorno;
}
