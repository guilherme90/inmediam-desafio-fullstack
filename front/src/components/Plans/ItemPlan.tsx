import { useNavigate } from 'react-router-dom'

interface Props {
  id: number;
  description: string;
  numberOfClients: number;
  gigabytesStorage: number;
  price: number;
}

export const ItemPlan = ({ id, description, numberOfClients, gigabytesStorage, price }: Props) => {
  const navigate = useNavigate()

  const conClick = (id: number) => navigate(`/plans/${id}`)

  return (
    <>
      <div
        onClick={() => conClick(id)}
        className="box-content hover:box-content hover:bg-orange-50 focus:cursor-poibter bg-white h-72 w-80 pr-0 pt-7 rounded-lg shadow-lg">
        {numberOfClients === 1 && (
          <header className="box-content bg-orange-500 h-11 w-60 border-1 pl-5 pt-1.5 pb-1.5">
            <h1 className="text-white font-extrabold">{description}</h1>
          </header>
        )}

        {numberOfClients > 1 && (
          <header className="box-content bg-orange-500 h-11 w-60 border-1 pl-5 pt-1.5 pb-1.5">
            <h1 className="text-white font-extrabold">Até {gigabytesStorage} vistorias</h1>
            <h3 className="text-white font-bold">/clientes ativos</h3>
          </header>
        )}

        <div className="pt-5 text-2xl pl-5 text-gray-700">
          <p>Preço:</p>
          <span className="text-3xl font-bold">R$ {price}</span>
          <span> /mês</span>
        </div>

        <div className="pt-5 text-2xl pl-5 text-gray-700">
          <p>Armazenamento:</p>
          <span className="text-3xl font-bold">{gigabytesStorage} GB</span>
        </div>
      </div>
    </>
  )
}
