import { useNavigate, useParams } from 'react-router-dom'
import { useGetPlan } from '@/hooks/usePlans.ts'
import { useGetContract } from '@/hooks/useContracts.ts'
import { useState } from 'react'
import { post } from '@/utils/http.ts'

export const Plan = (): JSX.Element => {
  const { id } = useParams()
  const plan = useGetPlan(id)
  const contract = useGetContract(1)
  const navigate = useNavigate()
  const [hirePlanLoading, setHirePlanLoading] = useState<boolean>(false)

  const onClickHirePlan = async (userId: number, planId: number, price: number) => {
    setHirePlanLoading(true)

    try {
      await post('/plans/contracts', {
        user_id: userId,
        plan_id: planId,
        price,
        type_invoice: 'debit',
        type_payment: 'pix'
      })

      setHirePlanLoading(false)
      navigate('/contracts/pay')
    } catch (e) {
      setHirePlanLoading(false)
    }
  }

  return (
    <div>
      {contract && (
        <div className="grid justify-center">
          <header>
            <h1 className="align-middle text-gray-900 text-3xl font-bold text-center pb-5">Seu plano atual</h1>
            <h3 className="text-gray-700">{contract?.plan.description}</h3>
            <h4 className="text-gray-700"><strong>R$ {contract?.plan.price}</strong> com {contract?.plan.gigabytes_storage} GB de armazenamento</h4>
          </header>
        </div>
      )}

      {plan && (
        <div className="grid pt-10 justify-center">
          <div className="justify-center">
            <h1 className="align-middle text-orange-500 text-3xl font-bold text-center pb-5">Plano selecionado</h1>
            <div className="box-content bg-white h-72 w-96 pr-0 pt-7 rounded-lg shadow-lg">
              {plan?.number_of_clients === 1 && (
                <header className="box-content bg-orange-500 h-11 w-60 border-1 pl-5 pt-1.5 pb-1.5">
                  <h1 className="text-white font-extrabold">{plan.description}</h1>
                </header>
              )}

              {plan?.number_of_clients > 1 && (
                <header className="box-content bg-orange-500 h-11 w-72 border-1 pl-5 pt-1.5 pb-1.5">
                  <h1 className="text-white font-extrabold">Até {plan.gigabytes_storage} vistorias</h1>
                  <h3 className="text-white font-bold">/clientes ativos</h3>
                </header>
              )}

              <div className="pt-5 text-2xl pl-5 text-gray-700">
                <p>Preço:</p>
                <span className="text-3xl font-bold">R$ {plan?.price}</span>
                <span> /mês</span>
              </div>

              <div className="pt-5 text-2xl pl-5 text-gray-700">
                <p>Armazenamento:</p>
                <span className="text-3xl font-bold">{plan?.gigabytes_storage} GB</span>
              </div>
            </div>
          </div>

          <div className="justify-center">
            {plan.id !== contract?.plan_id && (
              <button
                type="button"
                disabled={hirePlanLoading}
                onClick={() => onClickHirePlan(1, plan.id, plan?.price)}
                className="align-middle text-center bg-gray-700 hover:bg-gray-800 text-white p-3 rounded-lg shadow-lg w-full">
                {hirePlanLoading ? 'Aguarde...' : 'Selecionar plano'}
              </button>
            )}
          </div>

        </div>
      )}


    </div>
  )
}