interface Props {
  loading: boolean;
}

export const Spinner = ({ loading }: Props): JSX.Element => {
  return (
    <div className="grid justify-center pb-5">
      {loading && (
        <span className="text-gray-500 text-xl">Carregando...</span>
      )}
    </div>
  )
}