class Mascaras{
    constructor(){

    }

    setItemMascara(item, mascara,datasValidate=null,isNumber = false,validaDataMenor=false){
        item.onkeyup = function(e) {
            if ((e.which >36 && e.which < 41) || e.which == 8) {
                return;
            }
            Mascaras.setValueItem(item,mascara,datasValidate,isNumber,validaDataMenor);
        };
    }

    static setValueItem(item,mascara,datasValidate,isNumber,validaDataMenor){
        item.value = (isNumber) ? Mascaras.setNumber(item.value) : item.value;
        item.value = Mascaras._mascara(item.value, mascara);
        if (datasValidate != null && typeof datasValidate != 'undefined') {
            item.value = datasValidate.validaData(item,validaDataMenor);
        }
    }

    static setNumber(value){
        return value.replace(/[^0-9\.]/g,'');
    }

    static removeItens(value, mascara){
        for (let index = 0; index < mascara.length; index++) {
            const element = mascara[index];
            if (element != "#") {
                value = value.replaceAll(element,"");
            }
        }
        return value;
    }
    
    static existeItem(value, mascara){
        for (let index = 0; index < mascara.length; index++) {
            const element = mascara[index];
            if (value[value.length-1] == element && element != "#") {
                return value.substring(0, value.length-1);
            }
        }
        return value;
    }
    
    static _mascara(id, mask){
        id = Mascaras.removeItens(id, mask);
        let mascara = mask;
        for (let index = 0; index < id.length; index++) {
            mask = mask.replace("#",id[index]);
        }
        let retorno = '';
        for (let index = 0; index < mask.length; index++) {
            const element = mask[index];
            if (element != "#") {
                retorno += ""+element;
            }else{
                break;
            }
        }
        retorno = Mascaras.existeItem(retorno, mascara);
        return retorno;
    }
    
}