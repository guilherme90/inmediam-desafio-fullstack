import { useEffect, useState } from 'react'
import { get } from '@/utils/http.ts'
import { IPlan } from '@/hooks/usePlans.ts'

export interface IContract {
  id: number;
  plan_id: number;
  price: string;
  hiring_date: string;
  payments: {
    id: number;
    contract_id: number;
    price_contracted: string;
    balance: string;
    type_invoice: string;
    type_payment: string
    status: string
  }[],
  plan: IPlan
}

export function useGetContract (userId: number) : { contract: IContract | null, contractLoading: boolean } {
  const [contractLoading, setContractLoading] = useState<boolean>(false)
  const [contract, setContract] = useState<IContract | null>(null)

  useEffect(() => {
    setContractLoading(true)
    const request = async () => {
      const response = await get<IContract>(`/plans/contracts/${userId}`) as IContract
      setContract(response)
      setContractLoading(false)
    }

    request()
  }, [])

  return { contract, contractLoading }
}