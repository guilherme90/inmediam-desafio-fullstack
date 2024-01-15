import { ItemPlan } from '@/components/Plans/ItemPlan.tsx'
import { useListPlans } from '@/hooks/usePlans.ts'
import { Spinner } from '@/components/Spinner/Spinner.tsx'

export const Home = (): JSX.Element => {
  const { plans, plansLoading } = useListPlans()

  return (
    <>
      <Spinner loading={plansLoading} />

      <div className="flex items-center justify-center">
        <div className="grid grid-cols-3 gap-10">
          {plans.map((item) => (
            <ItemPlan
              id={item.id}
              description={item.description}
              price={item.price}
              numberOfClients={item.number_of_clients}
              gigabytesStorage={item.gigabytes_storage} key={item.id}/>
          ))}
        </div>
      </div>
    </>
  )
}