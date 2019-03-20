<?php
/**
 * Git Branch entity
 *
 * @author Ian <ian@ianh.io>
 * @since 20/03/2019
 */

namespace Icawebdesign\GitInfo\Models;

class GitBranchEntity
{
    /** @var string */
    protected $branch;

    /**
     * @param string $branch
     * @return GitBranchEntity
     */
    public function setBranch(string $branch): GitBranchEntity
    {
        $this->branch = $branch;
        return $this;
    }

    /**
     * @return string
     */
    public function getBranch(): string
    {
        return $this->branch;
    }
}
