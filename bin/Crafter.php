<?php

namespace Console;

use Exception;

class Crafter
{
    private $config;

    public function run($command, $arguments)
    {
        if (is_null($command)) {
            $this->printHelp();
            return;
        }

        switch ($command) {
            case "create:controller":
                $this->createController($arguments);
                break;
            case "create:repository":
                $this->createRepository($arguments);
                break;
            case "create:entity":
                $this->createEntity($arguments);
                break;
            case "create:config":
                $this->createNewConfig($arguments);
                break;
            default:
                echo "Unknown command: $command\n";
                $this->printHelp();
                break;
        }
    }

    /**
     * Create a new file with the given content.
     * This method ensures that the directory exists and the file does not already exist.
     *
     * @param string $filePath The path to the file.
     * @param string $content The content to write to the file.
     * @throws Exception If the file already exists or if it cannot be created.
     */
    private function createFile(string $filePath, string $content): void
    {
        $directory = dirname($filePath);
        if (!is_dir($directory)) {
            if (!mkdir($directory, 0755, true)) {
                throw new Exception("Failed to create directory: $directory");
            }
        }

        if (file_exists($filePath)) {
            throw new Exception("File already exists: $filePath");
        }

        if (file_put_contents($filePath, $content) === false) {
            throw new Exception("Failed to write file: $filePath");
        }

        echo "File created successfully: $filePath\n";
    }

    /**
     * Creates a new controller class file.
     * This function generates a new PHP class file for a controller in the 'app/Controllers' directory.
     * It uses the provided name or defaults to 'NewController' if no name is given. The controller
     * class is created with a basic structure including the namespace and an empty class body.
     *
     * @param array $arguments The arguments passed to the command. The first
     *                         argument is the controller name.
     *
     * @throws Exception If the file already exists or if it cannot be created.
     *
     * @return void
     *
     * Usage example:
     *    $this->createController(['User']);  // Creates a UserController
     */
    private function createController($arguments)
    {
        $controllerName = $arguments[0] ?? "NewController";
        $controllerName = ucfirst($arguments[0] ?? "New") . "Controller";
        $filePath = "app/Controllers/{$controllerName}.php";

        $controllerContent = "<?php\n\nnamespace App\Controllers;\n\nclass {$controllerName} extends BaseController\n{\n    // Add your controller methods here\n}\n";

        try {
            $this->createFile($filePath, $controllerContent);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }
    }

    /**
     * Creates a new repository class file.
     *
     * This function generates a new PHP class file for a repository in the 'app/Repositories' directory.
     * It uses the provided name or defaults to 'NewRepository' if no name is given. The repository
     * class is created with a basic structure including the namespace and an empty class body
     * that extends BaseRepository.
     *
     * @param array $arguments The arguments passed to the command. The first element, if present,
     *                         is used as the repository name.
     *
     * @throws Exception If there's an error in file creation, which is caught and its message displayed.
     *
     * @return void
     *
     * Usage example:
     *     $this->createRepository(['User']);  // Creates a UserRepository
     */
    private function createRepository($arguments)
    {
        $repositoryName = $arguments[0] ?? "NewRepository";
        $repositoryName = ucfirst($arguments[0] ?? "New") . "Repository";
        $filePath = "app/Repositories/{$repositoryName}.php";

        $repositoryContent = "<?php\n\nnamespace App\Repositories;\n\nclass {$repositoryName} extends BaseRepository\n{\n    // Add your repository methods here\n}\n";

        try {
            $this->createFile($filePath, $repositoryContent);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }
    }

    private function createNewConfig($arguments)
    {
        $configName = $arguments[0] ?? "NewConfig";
        echo "Creating new config file: $configName\n";
        echo "Arguments: " . implode(", ", $arguments) . "\n";
    }

    /**
     * Creates a new entity class file.
     *
     * This function generates a new PHP class file for an entity in the 'app/Entities' directory.
     * It uses the provided name or defaults to 'NewEntity' if no name is given. The entity
     * class is created with a basic structure including the namespace and an empty class body.
     *
     * @param array $arguments An array of command-line arguments. The first element, if present,
     *                         is used as the entity name.
     *
     * @throws Exception If there's an error in file creation, which is caught and its message displayed.
     *
     * @return void
     *
     * Usage example:
     *     $this->createEntity(['User']);  // Creates a User entity
     */

    private function createEntity($arguments)
    {
        $entityName = $arguments[0] ?? "NewEntity";
        $entityName = ucfirst($entityName);
        $filePath = "app/Entities/{$entityName}.php";

        $entityContent = "<?php\n\nnamespace App\Entities;\n\nclass {$entityName}\n{\n    // Add your entity properties here\n}\n";

        try {
            $this->createFile($filePath, $entityContent);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }
    }

    protected function printHelp()
    {
        echo "
                                                                       (      (
           (                  (         )                         (     )\ )   )\ )
           )\    (        )   )\ )   ( /(     (    (              )\   (()/(  (()/(
         (((_)   )(    ( /(  (()/(   )\())   ))\   )(           (((_)   /(_))  /(_))
         )\___  (()\   )(_))  /(_)) (_))/   /((_) (()\          )\___  (_))   (_))
        ((/ __|  ((_) ((_)_  (_) _| | |_   (_))    ((_)   ___  ((/ __| | |    |_ _|
         | (__  | '_| / _` |  |  _| |  _|  / -_)  | '_|  |___|  | (__  | |__   | |
          \___| |_|   \__,_|  |_|    \__|  \___|  |_|            \___| |____| |___|

                                                                                                                          \n\n";
        echo "Available Commands:\n";
        echo "  create:controller  Create a new controller\n";
        echo "  create:repository  Create a new repository\n";
        echo "  create:entity      Create a new entity\n";
        echo "  create:config      Create a new config\n";
        echo "\nUsage:\n";
        echo "  crafter <command> [arguments]\n";
        echo "\nExamples:\n";
        echo "  crafter create:controller User\n";
        echo "  crafter create:repository User\n";
        echo "  crafter create:entity User\n";
        echo "  crafter create:config database\n";
    }
}
