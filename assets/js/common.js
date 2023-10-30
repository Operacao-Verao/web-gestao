
const exp_nome = /[^a-zA-ZáàÁÀéèÉÈíìÍÌóòÓÒúùÚÙãçÃÇâÂêÊõÕôÔûÛ\s]/g;

function validarCpf(cpf) {
	let acu_v1 = 0;
	for (let i=0; i<9; i++){
		let digit = Number(cpf.charAt(i))||0;
		acu_v1 += digit*(10-i);
	}
	let ver1 = (11 - (acu_v1%11));
	ver1 = ver1>=10? 0: ver1;
	
	let acu_v2 = 0;
	for (let i=0; i<10; i++){
		let digit = Number(cpf.charAt(i))||0;
		acu_v2 += digit*(11-i);
	}
	let ver2 = (11 - (acu_v2%11));
	ver2 = ver2>=10? 0: ver2;

	return cpf.charAt(9)==ver1 && cpf.charAt(10)==ver2;
}
