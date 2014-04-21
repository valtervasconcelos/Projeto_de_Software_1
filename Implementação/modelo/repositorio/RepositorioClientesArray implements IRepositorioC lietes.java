import java.util.Vector;


public class RepositorioClientesArray implements IRepositorioClientes {

	private Cliente[] clientes;
	private int indice;
	private final static int tamCache = 100;
	
	public RepositorioClientesArray() {

		indice = 0;
		clientes = new Cliente[tamCache];
	}
	
	public void atualizar(Cliente c) throws ClienteInexistenteException, ErroAcessoRepositorioException {

		int i = procurarIndice(c.getCpf());
		if (i != -1) {
			clientes[i] = c;
		} else {
			throw new ClienteInexistenteException(c.getCpf());
		}
	}
		

	public void inserir(Cliente c) {

		clientes[indice] = c;
		indice = indice + 1;
	}
	
	

	private int procurarIndice(String cpf) {

		int i = 0;
		int ind = -1;
		boolean achou = false;

		while ((i < indice) && !achou) {
			if ((clientes[i].getCpf()).equals(cpf)) {
				ind = i;
				achou = true;
			}
			i = i + 1;
		}
		return ind;
	}
	
	public boolean existe(String cpf) {

		boolean resp = false;
		int i = this.procurarIndice(cpf);
		if (i != -1) {
			resp = true;
		}
		return resp;
	}	
	
	public void remover(String cpf) throws ClienteInexistenteException {

		if (existe(cpf)) {
			int i = this.procurarIndice(cpf);
			clientes[i] = clientes[indice - 1];
			clientes[indice - 1] = null;
			indice = indice - 1;
		} else {
			throw new ClienteInexistenteException(cpf);
		}
	}

	public Cliente procurar(String cpf) throws ClienteInexistenteException {

		Cliente c = null;
		if (existe(cpf)) {
			int i = this.procurarIndice(cpf);
			c = clientes[i];
		} else {
			throw new ClienteInexistenteException(cpf);
		}

		return c;
	}

	public Vector <Cliente> listar() throws ErroAcessoRepositorioException {
			System.out.println("Estou dentro de listar 11111");
		return null;
	}

		
	
	
	
	
		
}
