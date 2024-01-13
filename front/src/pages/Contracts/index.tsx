import { useGetContract } from '@/hooks/useContracts.ts'

export const Contracts = (): JSX.Element => {
  const contract = useGetContract(1)

  return (
    <>
      <div className="grid justify-center">
        <div className="justify-center">
          <h1 className="align-middle text-orange-500 text-3xl font-bold text-center pb-5">Meu Contrato</h1>
          <div className="box-content bg-white h-72 w-96 pr-0 pt-7 rounded-lg shadow-lg">
            {contract?.plan?.number_of_clients === 1 && (
              <header className="box-content bg-orange-500 h-11 w-60 border-1 pl-5 pt-1.5 pb-1.5">
                <h1 className="text-white font-extrabold">{contract?.plan.description}</h1>
              </header>
            )}

            {contract?.plan?.number_of_clients > 1 && (
              <header className="box-content bg-orange-500 h-11 w-72 border-1 pl-5 pt-1.5 pb-1.5">
                <h1 className="text-white font-extrabold">Até {contract?.plan.gigabytes_storage} vistorias</h1>
                <h3 className="text-white font-bold">/clientes ativos</h3>
              </header>
            )}

            <div className="pt-5 text-2xl pl-5 text-gray-700">
              <p>Preço:</p>
              <span className="text-3xl font-bold">R$ {contract?.plan?.price}</span>
              <span> /mês</span>
            </div>

            <div className="pt-5 text-2xl pl-5 text-gray-700">
              <p>Armazenamento:</p>
              <span className="text-3xl font-bold">{contract?.plan?.gigabytes_storage} GB</span>
            </div>
          </div>
        </div>
      </div>
    </>
  )
}