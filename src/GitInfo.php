<?php
/**
 * Global utility class
 *
 * @author Ian <ian@ianh.io>
 * @since  20/03/2019
 */

namespace Icawebdesign\GitInfo;

use Icawebdesign\GitInfo\Models\GitBranchEntity;
use Icawebdesign\GitInfo\Models\GitCommitEntity;

class GitInfo
{
    /** @var string */
    protected $rootPath;

    /** @var GitBranchEntity */
    protected $gitBranch;

    /** @var string */
    protected $branchPath;

    /** @var GitCommitEntity */
    protected $gitCommit;

    public function __construct(string $rootPath, GitBranchEntity $gitBranch, GitCommitEntity $gitCommit)
    {
        $this->rootPath = $rootPath;
        $this->gitBranch = $gitBranch;
        $this->gitCommit = $gitCommit;

        $this->branchPath = rtrim(
            mb_substr(file_get_contents(sprintf('%s/.git/HEAD', $this->rootPath)), 5)
        );
    }

    public function branchInfo(): GitBranchEntity
    {
        $this->gitBranch->setBranch(basename($this->branchPath));

        return $this->gitBranch;
    }

    public function commitInfo(): GitCommitEntity
    {
        $commitHash = rtrim(
            file_get_contents(sprintf('%s/.git/%s', $this->rootPath, $this->branchPath))
        );
        $this->gitCommit->setFullCommitHash($commitHash);
        $this->gitCommit->setRevision(mb_substr($commitHash, 0, 7));

        return $this->gitCommit;
    }
}
