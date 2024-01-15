import { useGetContract } from '@/hooks/useContracts.ts'
import { useState } from 'react'
import { useNavigate } from 'react-router-dom'
import { put } from '@/utils/http'
import { Spinner } from '@/components/Spinner/Spinner.tsx'

export const Pay = (): JSX.Element => {
  const { contract, loading } = useGetContract(1)
  const [payLoading, setPayLoading] = useState<boolean>(false)
  const navigate = useNavigate()

  const onClickPay = async (userId: number) => {
    setPayLoading(true)

    try {
      await put('/plans/contracts', {
        user_id: userId,
        contract_id: contract?.id
      })

      setPayLoading(false)
      navigate('/')
    } catch (e) {
      setPayLoading(false)
    }
  }

  return (
    <>
      <div className="grid justify-center">
        <Spinner loading={loading} />

        {contract && (
          <>
            <div className="justify-center">
              <h1 className="align-middle text-orange-500 text-3xl font-bold text-center pb-5">
                {contract.payments.length ? 'Mudança de plano' : 'Plano selecionado'}
              </h1>
              <div className="box-content bg-white h-96 w-96 pr-0 pt-7 rounded-lg shadow-lg">
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

                {!!contract.payments.length && (
                  <div className="pt-5 text-2xl pl-5 text-gray-700">
                    <p>Valor para pagamento:</p>
                    <span className="text-3xl font-bold">R$ {Math.abs(Number(contract.payments[0].balance))}</span>
                    <span> /somente hoje</span>
                  </div>
                )}

                <div className="pt-5 text-2xl pl-5 text-gray-700">
                  <p>Armazenamento:</p>
                  <span className="text-3xl font-bold">{contract?.plan?.gigabytes_storage} GB</span>
                </div>
              </div>
            </div>

            <div className="justify-center">
              <button
                type="button"
                disabled={payLoading}
                onClick={() => onClickPay(1)}
                className="align-middle text-center bg-gray-700 hover:bg-gray-800 text-white p-3 rounded-lg shadow-lg w-full">
                {payLoading ? 'Aguarde...' : 'Pagar plano'}
              </button>
            </div>
          </>
        )}
      </div>
    </>
  )
}