import { useEffect, useState } from 'react'
import { get, post } from '@/utils/http.ts'

export interface IPlan {
  id: number;
  description: string;
  number_of_clients: number;
  gigabytes_storage: number;
  price: number;
}

export function useListPlans (): IPlan[] {
  const [plans, setPlans] = useState<IPlan[]>([])

  useEffect(() => {
    const request = async () => {
      const response = await get<IPlan[]>('/plans') as IPlan[]
      setPlans(response)
    }

    request()
  }, [])

  return plans
}

export function useGetPlan(id?: string): IPlan | null {
  const [plan, setPlan] = useState<IPlan | null>(null)

  useEffect(() => {
    const request = async () => {
      const response = await get<IPlan>(`/plans/${id}`) as IPlan
      setPlan(response)
    }

    request()
  }, [])

  return plan
}

export function useCHirePlan(userId: number, planId: number, price: number): void {
  useEffect(() => {
    const request = async () => {
      await post('/plans/contracts', {
        user_id: userId,
        plan_id: planId,
        price,
        type_invoice: 'debit',
        type_payment: 'pix'
      })
    }

    request()
  }, [])
}