<?php

class UserDataInput
{
    public int $id;
    public string $name;
    public int $age;

    public function __construct(int $id, string $name, int $age)
    {
        $this->id = $id;
        $this->name = $name;
        $this->age = $age;
    }

    public static function fromArray(array $data): self
    {
        return new self($data['id'], $data['name'], $data['age']);
    }

    public function toArray(): array
    {
        return ['id' => $this->id, 'name' => $this->name, 'age' => $this->age];
    }
}

require_once 'ExcelEditor.php';

class UserExcelEditor extends ExcelEditor
{
    protected function handle(array $data): array
    {
        $processedData = [];
        foreach ($data as $user) {
            if (is_array($user)) {
                $user = UserDataInput::fromArray($user);
            }
            if (!$user instanceof UserDataInput) {
                throw new InvalidArgumentException("All data items must be UserDataInput instances or arrays");
            }
            $userData = $user->toArray();
            $userData['is_adult'] = $user->age >= 18;
            $processedData[] = $userData;
        }
        return $processedData;
    }

    public function processAndSave(string $filename, array $users): array
    {
        $processedData = $this->handle($users);
        $this->addToFile($filename, $processedData);
        return $processedData; // Возвращаем данные для отображения
    }
}